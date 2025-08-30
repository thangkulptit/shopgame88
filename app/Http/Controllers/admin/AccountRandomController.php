<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AccountRandom;
use App\Models\TypeAccount;
use App\Http\Requests\AddTypeAccount;
use App\Common\common;

class AccountRandomController extends Controller
{

    public function getAccount(){
        $data['accountlist'] = AccountRandom::paginate(10);
        $data['type_account'] = TypeAccount::get();
        $data['accountlist'] = Common::convertTypeAccountText($data['accountlist']);

        return view('backend/account-random', $data);
    }

    public function fetchDataAccount(Request $request){
        if ($request->ajax()){
            $data['accountlist'] = AccountRandom::paginate(10);
            return view('backend/paginations/pagination_account-random', $data);
        }
    }

    public function getAddAccount(){
        $data['type_account'] = TypeAccount::get();
        return view('backend/add-account-random', $data);
    }

    public function postUpdateAccount(Request $request) {
        $id = $request->route('id');
        $accCurrent = AccountRandom::find($id);
        $accCurrent->type_account = $request->type_account;
        $accCurrent->content = $request->content;
        $accCurrent->username = $request->username;
        $accCurrent->password = $request->password;
        $accCurrent->url_image = $request->url_image;
        $accCurrent->price = $request->price;
        $accCurrent->status = isset($request->status) && $request->status==1 ? $request->status : 0 ;
        $accCurrent->save();

        $allAcc = AccountRandom::all();

        $htmlResponse = $this->outputUpdateDeleteAccount($allAcc);

        return response()->json([
            'message' => 'success',
            'data' => $htmlResponse,
        ]);
    }

    private function outputUpdateDeleteAccount($allAcc){
        $output = '';
        foreach ($allAcc as $rows) {
            $output = $output.'<tr><td>'.$rows->type_account.'</td><td>'.$rows->username.'</td><td>'.$rows->password.'</td><td>'.$rows->price.'</td><td>'.$rows->content.'</td>';
             if ($rows->status == 1) {
                 $output = $output.'<td><span class="badge badge-success">Active</span></td>';
             } else {
                 $output = $output.'<td><span  class="badge badge-danger">UnActive</span></td>';
             }

            $output = $output.'<td><button id="btn-update" id-data="'.$rows->acc_id.'" class="btn btn-primary"><i class="cui-pencil"></i></button><button id="btn-delete" id-data="'.$rows->acc_id.'" class="btn btn-danger"><i class="cui-delete"></i></button></td></tr>';
        }
        return $output;
    }

    public function postDeleteAccount(Request $request) {
        $id = $request->route('id');
        $user = AccountRandom::find($id);
        if($user){
            $destroy = AccountRandom::destroy($id);
            if ($destroy) {
                $allAcc = AccountRandom::all();
                $htmlResponse = $this->outputUpdateDeleteAccount($allAcc);
                $dataResponse = [
                    'message' => 'success',
                    'data'    => $htmlResponse
                ];
            } else {
                $dataResponse = [
                    'message' => 'faild',
                    'data'    => 'null'
                ];
            }
            return response()->json($dataResponse);
        }
    }
    
    public function postAddTypeAccount(Request $request) {

        $typeAccount = new TypeAccount();
        $typeAccount->name = $request->name;
        $typeAccount->save();
        return redirect()->back()->withInput()->with('success','Thêm TypeAccount thành công');
    }

    public function postAddAccount(Request $request) {
        $account = new AccountRandom();
        $account->type_account = $request->type_account;
        $account->username = $request->username;
        $account->password = $request->password;
        $account->url_image = $request->url_image;
        $account->price = $request->price;
        $account->content = isset($request->content) ? $request->content : 'Trắng thông tin';
        $account->status = 1;
        $account->save();

        return redirect()->back()->withInput()->with('success', 'Thêm account thành công');

    }

    public function postFetchAccount(Request $request){
        $id = $request->route('id');
        $data = AccountRandom::where('acc_id', $id)->take(1)->get();

        return response()->json([
            'message' => 'success',
            'data'    => $data
        ], 200);
    }

    
}
