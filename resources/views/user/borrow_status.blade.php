@extends('components.layout')
@section(('title'), 'Borrow Status')
@section('content')
<div class="heading">
    <h3>borrow status</h3>
    <p> <a href="{{route("index")}}">home</a> / borrow </p>
</div>
<section class="borrow-status">
    <h3>Borrow Status</h3>
    <div class="borrow-status-container">
        <table>
            <thead class="tb-head">
                <tr>
                    <th>Cover</th>
                    <th>Book</th>
                    <th>Borrow Date</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Return Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="tb-body">
                <tr class="tb-body-child">
                    <td class="tb-body-child-img"><img
                            src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg"
                            alt="tb-body-child-img"></td>
                    <td>Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</td>
                    <td>Thứ tư - 23/10</td>
                    <td>Thứ tư - 30/10</td>
                    <td>On Loan</td>
                    <td></td>
                    <td><button>Extend</button></td>
                </tr>
                <tr class="tb-body-child">
                    <td class="tb-body-child-img"><img
                            src="images/doraemon-tieu-thuyet_nobita-va-ban-giao-huong-dia-cau_bia.jpg"
                            alt="tb-body-child-img"></td>
                    <td>Doraemon - Tiểu Thuyết - Nobita Và Bản Giao Hưởng Địa Cầu</td>
                    <td>Thứ tư - 23/10</td>
                    <td>Thứ tư - 30/10</td>
                    <td>On Loan</td>
                    <td></td>
                    <td><button>Extend</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</section>
@endsection