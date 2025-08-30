<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UserClient;

class MemberController extends Controller
{

    public function getPageMember() {
        $data['members'] = UserClient::paginate(10);
        return view('backend.members', $data);
    }

    public function fetchDataMembers(Request $request) {
        if ($request->ajax()){
            $data['members'] = UserClient::paginate(10);
            return view('backend/paginations/pagination_member', $data);
        }
    }

    public function searchNameMembers(Request $request) {
        if ($request->ajax()){
            $search = $request->get('name');
            $query = UserClient::query()
                ->where('name', 'LIKE', "%{$search}%")
                ->orWhere('uid', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->get();
            $data['members'] = $query;
            $html = $this->outputHtmlUser($query, 1);
            return response()->json([
                'data' => $data,
                'html' => $html
            ]);
            // dd($data);
            // $data['members'] = UserClient::paginate(10);
            // return view('backend/paginations/pagination_member', $data);
        }
    }

    public function updateMoneyUser(Request $request) {
        if ($request->ajax()) {
            $status = false;
            $id = $request->get('id');
            $moneyUpdate = $request->get('money');
            
            if (isset($id) && isset($moneyUpdate)) {
                $userCurrent = UserClient::find($id);
                $userCurrent->money = $moneyUpdate;
                $userCurrent->save();
                $status = true;
                $outputHtml = $this->outputHtmlUser($userCurrent, 2);
            }
            return response()->json([
                'status' => $status,
                'id' => $id,
                'output' => $outputHtml
            ]);
        }
    }

    public function plusMoneyUser(Request $request) {
        if ($request->ajax()) {
            $status = false;
            $id = $request->get('id');
            $moneyUpdate = $request->get('money');
    
            if (isset($id) && isset($moneyUpdate)) {
                $userCurrent = UserClient::find($id);
                $userCurrent->money = $userCurrent->money + $request->money;
                $userCurrent->save();
                $status = true;
                $outputHtml = $this->outputHtmlUser($userCurrent, 2);
            }
            return response()->json([
                'status' => $status,
                'id' => $id,
                'output' => $outputHtml
            ]);
        }
    }

    public function outputHtmlUser($userCurrent, $flag) {
        $output = '';
        switch($flag) {
            case 1:
            foreach($userCurrent as $rows) {
                $output = 
                $output.'<tr id="row-member-'.$rows->id.'">
                        <td class="text-center">
                            <div class="avatar">
                            <img class="img-avatar" src="img/avatars/1.jpg" alt="admin@bootstrapmaster.com">
                            <span class="avatar-status badge-success"></span>
                            </div>
                        </td>
                        <td>
                        <div>'. $rows->name .'</div>
                        <div class="small text-muted">
                        <span>New</span> | Registered: '. $rows->created_at .'</div>
                    </td>
                    <td>
                        <div> '.$rows->username.' </div>
                    </td>
                    <td class="text-center">
                            <strong>'. $rows->uid .'</strong>
                    </td>
                    <td>
                        <div class="clearfix">
                        <div class="float-left">
                            <strong>'. $rows->email .'</strong>
                        </div>
                        </div>
                    </td>
                        <td class="text-center">
                            <strong> '. number_format($rows->money) .' <sup>VNĐ</sup></strong>
                    </td>
                    <td>
                            <button class="btn btn-info" id="btnUpdateMoney" member-id="'.$rows->id.'" ><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger" id="btnPlusMoney" member-id="'.$rows->id.'" ><i class="fa fa-plus fa-lg mt-1"></i></button>
                    </td>
                    </tr>';
            }
            break;
            case 2: 
            $output = 
            $output.'
                    <td class="text-center">
                        <div class="avatar">
                        <img class="img-avatar" src="img/avatars/1.jpg" alt="admin@bootstrapmaster.com">
                        <span class="avatar-status badge-success"></span>
                        </div>
                    </td>
                    <td>
                <div>'. $userCurrent->name .'</div>
                    <div class="small text-muted">
                    <span>New</span> | Registered: '. $userCurrent->created_at .'</div>
                </td>
                <td>
                    <div> '.$userCurrent->username.' </div>
                </td>
                <td class="text-center">
                        <strong>'. $userCurrent->uid .'</strong>
                </td>
                <td>
                        <div class="clearfix">
                        <div class="float-left">
                            <strong>'. $userCurrent->email .'</strong>
                        </div>
                        </div>
                    </td>
                    <td class="text-center">
                        <strong> '. number_format($userCurrent->money) .' <sup>VNĐ</sup></strong>
                </td>
                <td>
                        <button class="btn btn-info" id="btnUpdateMoney" member-id="'.$userCurrent->id.'" ><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger" id="btnPlusMoney" member-id="'.$userCurrent->id.'" ><i class="fa fa-plus fa-lg mt-1"></i></button>
                </td>';
            break;
            default: break;

        }
        return $output;
    }
}
