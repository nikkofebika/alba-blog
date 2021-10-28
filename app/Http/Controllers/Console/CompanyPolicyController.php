<?php

namespace App\Http\Controllers\Console;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\CompanyPolicy;
use Illuminate\Support\Facades\DB;

class CompanyPolicyController extends Controller {
	public function index() {
		$policies = CompanyPolicy::orderBy('priority', 'asc')->orderBy('updated_at', 'desc')->get();
		return view('console.company_policies.index', ['page_title' => 'Company Policy', 'active_menu' => 'company-policies', 'policies' => $policies]);
	}

	public function create() {
		return view('console.company_policies.create', ['page_title' => 'Company Policy - Tambah Data', 'active_menu' => 'company-policy']);
	}

	public function store(Request $request) {
		$request->validate([
			'title' => 'required|unique:company_policies,title',
			'description' => 'required',
			'priority' => 'required',
			'file' => 'mimes:jpeg,png,jpg,svg,pdf,doc,docx,xls,xlsx|max:2048',
		]);

		$file_name = null;
		if ($request->hasFile('file')) {
			if ($request->file->isValid()) {
				$fileName = Str::slug($request->title, '-').'-'.time().'.'.$request->file->extension();
				$dir = '/files/';
				if (!file_exists(public_path($dir))) {
					mkdir(public_path($dir), 0777, true);
					chmod(public_path($dir), 0777);
				}
				$request->file->move(public_path($dir), $fileName);
				$file_name = $dir.$fileName;
			}
		}

		$ar = new CompanyPolicy;
		$ar->title = trim($request->title);
		$ar->description = trim($request->description);
		$ar->file = $file_name;
		$ar->created_by = auth()->guard('admin')->user()->id;
		$ar->priority = $request->priority;
		$ar->save();
		return redirect('console/company-policies')->with('notification', $this->flash_data('success', 'Berhasil', 'Company policy berhasil ditambahkan'));
	}

	public function show($id) {
		$policy = CompanyPolicy::findOrFail($id);
		return view('console.company_policies.show', ['policy' => $policy, 'page_title' => 'Company Policy - Edit Data', 'active_menu' => 'company-policy']);
	}

	public function edit($id) {
		$policy = CompanyPolicy::findOrFail($id);
		return view('console.company_policies.edit',['policy' => $policy, 'page_title' => 'Company Policy - Edit Data', 'active_menu' => 'company-policy']);
	}

	public function update(Request $request, $id) {
		$request->validate([
			'title' => 'required|unique:company_policies,title,'.$id,
			'description' => 'required',
			'priority' => 'required',
			'file' => 'mimes:jpeg,png,jpg,svg,pdf,doc,docx,xls,xlsx|max:2048',
		]);

		$ar = CompanyPolicy::findOrFail($id);
		$file_name = null;
		if ($request->hasFile('file')) {
			if ($request->file->isValid()) {
				$fileName = Str::slug($request->title, '-').'-'.time().'.'.$request->file->extension();
				$dir = '/files/';
				if (!file_exists(public_path($dir))) {
					mkdir(public_path($dir), 0777, true);
					chmod(public_path($dir), 0777);
				}
				if ($ar->file != null && file_exists(public_path($ar->file))) {
					unlink(public_path($ar->file));
				}
				$request->file->move(public_path($dir), $fileName);
				$file_name = $dir.$fileName;
			}
		} elseif ($request->has('existing_file') && $request->existing_file != '') {
			$file_name = $ar->file;
		} else {
			if ($ar->file != null && file_exists(public_path($ar->file))) {
				unlink(public_path($ar->file));
			}
		}

		$ar->title = trim($request->title);
		$ar->description = trim($request->description);
		$ar->file = $file_name;
		$ar->priority = $request->priority;
		$ar->save();
		return redirect('console/company-policies')->with('notification', $this->flash_data('success', 'Berhasil', 'Company policy berhasil diupdate'));
	}

	public function destroy($id) {
		$policy = CompanyPolicy::findOrFail($id);
		if ($policy->file != null && file_exists(public_path($policy->file))) {
			unlink(public_path($policy->file));
		}
		$policy->delete();
		return redirect('console/company-policies')->with('notification', $this->flash_data('success', 'Berhasil', 'Company policy berhasil dihapus'));
	}

	public function ajax_approve_policy(Request $request) {
		if ($request->ajax()) {
			if ($request->val == 1) {
				DB::table('company_policies')->where('id', $request->policy_id)->update(["approved_by" => auth()->guard('admin')->user()->id]);
				return ['success'=>true, 'message'=> 'Company policy Aktif'];
			} else {
				DB::table('company_policies')->where('id', $request->policy_id)->update(["approved_by" => null]);
				return ['success'=>false, 'message'=> 'Company policy Nonaktif'];
			}
		}
	}
}
