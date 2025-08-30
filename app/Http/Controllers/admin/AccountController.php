<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\TypeAccount;
use App\Common\common;
use Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class AccountController extends Controller
{

    public function __contructor($request, Closure $next){
        if (Auth::check()) {
            return $next($request);
        } else {
            return response()->json([
                'rcode' => '403',
                'msg' => 'Unauthorized'
            ]);
        }
    }

    public function getAccount(){
        $data['accountlist'] = DB::table('accounts')
            ->join('type_accounts', 'accounts.type_account', '=', 'type_accounts.ta_id')
            ->select('accounts.*', 'type_accounts.name as type_account_name')
            ->paginate(30);
        $data['type_account'] = TypeAccount::get();


        return view('backend/account', $data);
    }

    public function fetchDataAccount(Request $request){
        if ($request->ajax()){
            $data['accountlist'] = DB::table('accounts')
            ->join('type_accounts', 'accounts.type_account', '=', 'type_accounts.ta_id')
            ->select('accounts.*', 'type_accounts.name as type_account_name')
            ->paginate(30);
            $data['type_account'] = TypeAccount::get();

            return view('backend/paginations/pagination_account', $data);
        }
    }

    public function getAddAccount(){
        $data['type_account'] = TypeAccount::get();
        $data['rank'] = Common::getArrRank();
        return view('backend/add-account', $data);
    }

    public function getUpdateAccount(Request $request) {
        $data['type_account'] = TypeAccount::get();
        $data['rank'] = Common::getArrRank();
        $data['account'] = Account::find($request->route('id'));
        return view('backend/add-account', $data);
    }
    public function postUpdateAccount(Request $request) {
        $id = $request->route('id');
        $account = Account::find($id);
        $account->type_account = $request->type_account;
        $account->username = $request->username;
        $pass = $request->password;
        $arrPass = explode("|", $pass); 
        $account->password = $arrPass[0];
        $account->password2 = isset($arrPass[1]) ? $arrPass[1] : null;

        $account->url_image = $request->url_image;
        $account->price = $request->price;
        $account->content = isset($request->content) ? $request->content : 'Trắng thông tin';
        $account->status = 1;
        $account->count_champs = $request->count_champs;
        $account->count_ngoc = $request->count_ngoc;
        $account->count_skins = $request->count_skins;
        $account->rank = $request->rank;
        $account->da_quy = $request->da_quy;
        $account->url_champs = $request->url_champs;
        $account->url_ngocs = $request->url_ngocs;
        $account->url_skins = $request->url_skins;

        $account->vip_level = $request->vip_level;
        $account->vip_name = $request->vip_name;
        $account->vip_content = $request->vip_content;
        $account->vip_main = $request->vip_main;

        $account->save();
        return redirect()->back()->withInput()->with('success', 'Update account thành công');
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
        $user = Account::find($id);
        if($user){
            $destroy = Account::destroy($id);
            if ($destroy) {
                $allAcc = Account::all();
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
        $fileExist = false;
        $images = array();
        if($files = $request->file('url_images')){
            foreach($files as $index => $file) {
                $fileName = time().'x'.$index.$file->getClientOriginalName();
                $pathFile = public_path('/images/account/');
               
                $file->move($pathFile, $fileName);
                $images[] = $fileName;
            }
            $fileExist = true;
        }
        $stringPath = Common::getPathArrayImg($images);
        // if (isset($file)) {
        //     $fileExist = true;
        //     $fileName = time().'x'.$file->getClientOriginalName();
        //     $pathFile = public_path('/images/account/');
        //     $file->move($pathFile, $fileName);
        // }
       
        $account = new Account();
        $account->type_account = $request->type_account;
        $account->username = $request->username;
        $pass = $request->password;

        $arrPass = explode("|", $pass); 
        $account->password = $arrPass[0];
        $account->password2 = isset($arrPass[1]) ? $arrPass[1] : null;

        $account->url_image = $fileExist == true ? $stringPath : $request->url_image;
        $account->price = $request->price;
        $account->content = isset($request->content) ? $request->content : 'Trắng thông tin';
        $account->status = 1;
        $account->count_champs = $request->count_champs;
        $account->count_ngoc = $request->count_ngoc;
        $account->count_skins = $request->count_skins;
        $account->rank = $request->rank;
        $account->da_quy = $request->da_quy;
        $account->url_champs = $request->url_champs;
        $account->url_ngocs = $request->url_ngocs;
        $account->url_skins = $request->url_skins;

        $account->vip_level = $request->vip_level;
        $account->vip_name = $request->vip_name;
        $account->vip_content = $request->vip_content;
        $account->vip_main = $request->vip_main;

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
