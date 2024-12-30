<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\BorrowBook;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class UserController extends Controller
{
    public function borrowBook()
    {
        $checkoutCart = Cart::where('user_id', Auth::user()->id)->where('status', 'onActive')->whereNotNull('checkout_date')->first();
        log::info($checkoutCart);
        $borrowed_books = borrowBook::where('user_id', Auth::user()->id)->whereNot('status', 'returned')->get();
        return view('user.borrow_status', compact('checkoutCart', 'borrowed_books'));
    }

    public function extendBorrow(Request $request)
    {
        $borrowed_book = BorrowBook::find($request->id);
        if ($borrowed_book->status != 'borrowed') {
            if ($borrowed_book->status == 'overdue') {
                return redirect()->back()->with('error', 'You cannot extend an overdue book');
            }
            elseif ($borrowed_book->status == 'returned') {
                return redirect()->back()->with('error', 'You cannot extend a returned book');
            }
            elseif ($borrowed_book->status == 'extended') {
                return redirect()->back()->with('error', 'You cannot extend an already extended book');
            }
        }
        $borrowed_book->status = 'extended';
        $borrowed_book->due_date = Carbon::parse($borrowed_book->due_date)->addDays(7);
        $borrowed_book->save();
        return redirect()->back()->with('success', 'Book extended successfully');
    }

    public function activate($id)
    {
        return view('user.activate_user', ['id' => $id]);
    }

    public function payment(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_ReturnUrl = route('payment.callback');
        $vnp_TmnCode = "R3H3AH1R";
        $vnp_HashSecret = "GHZHZJXD03016KVK3FFHUKE2PIN805QW";

        $vnp_TxnRef = Carbon::now()->timestamp;
        $vnp_OrderInfo = "Library Card Activation Fee";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = 50000 * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_ReturnUrl,
            "vnp_TxnRef" => $vnp_TxnRef
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        return redirect($vnp_Url);
    }

    public function paymentCallback(Request $request)
    {
        if($request->vnp_ResponseCode == "00") {
            $user = Auth::user();
            $user->active_status = 'active';
            $user->activated_at = now();
            $user->save();

            return redirect()->route('index')->with('success', 'Payment successful! Your library card is now activated.');
        }

        return redirect()->route('index')->with('error', 'Payment failed! Please try again.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit_profile', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $imgPath = 'uploads/avatars/';
            $imgName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path($imgPath), $imgName);
            $avatarPath = $imgPath . $imgName;
            $user->avatar_path = $avatarPath;
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->date_of_birth = $request->date_of_birth;

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function editPassword()
    {
        return view('user.change_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
            'new_password_confirmation' => 'required'
        ]);

        if($request->new_password != $request->new_password_confirmation) {
            return back()->with('error', 'New password and confirm password do not match');
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password changed successfully');
    }

    public function borrowList()
    {
        $temp_list = array(
            [
                'title' => 'the lord of the rings',
                'author' => 'j.r.r. tolkien',
                'borrowed at' => '2021-01-01',
                'returned at' => '2021-01-15',
            ],
            [
                'title' => 'the hobbit',
                'author' => 'also j.r.r. tolkien',
                'borrowed at' => '2021-01-01',
                'returned at' => '2021-01-15',
            ],
            [
                'title' => 'the silmarillion',
                'author' => 'nope, still j.r.r. tolkien',
                'borrowed at' => '2021-01-01',
                'returned at' => '2021-01-15',
            ],
        );

        foreach ($temp_list as $key => $value) {
            $temp_list[$key]['title'] = ucwords($value['title']);
        }


        return view('user.borrow_list', ['books' => $temp_list]);
    }
}
