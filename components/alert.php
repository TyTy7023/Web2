<?php
// 1. `if(isset($sucess_msg)){`: Dòng này kiểm tra xem biến `$success_msg` 
    //đã được khai báo và có giá trị không. Nếu đã tồn tại, điều kiện này trở thành `true`, và mã trong khối `{}` sẽ được thực thi.

// 2. `foreach ($sucess_msg as $sucess_msg){`: Dòng này sử dụng vòng lặp `foreach` để lặp qua mỗi phần tử trong mảng `$success_msg`. Biến `$success_msg` sẽ chứa giá trị của mỗi phần tử trong mỗi lần lặp.

// 3. `echo '<script> swal("'.$sucess_msg.' ","","sucess") </script>';`: Trong mỗi lần lặp, mã JavaScript được xuất ra thông qua hàm `echo`
//. Mã này sử dụng `swal()` (hàm từ thư viện SweetAlert) để tạo một hộp thoại cảnh báo (alert) có nội dung là giá trị của biến `$success_msg`.
// Các tham số tiếp theo (`""`) là các thiết lập tùy chọn cho hộp thoại cảnh báo
//. Trong trường hợp này, có thể là các thiết lập của SweetAlert để hiển thị thông báo thành công.
    if(isset($success_msg)){
        foreach ($success_msg as $success_msg){
            echo '<script> swal("'.$success_msg.' ","","success"); </script>';
        }
    }
    if(isset($warning_msg)){
        foreach ($warning_msg as $warning_msg){
            echo '<script> swal("'.$warning_msg.' ","","sucess"); </script>';
        }
    }
    if(isset($info_msg)){
        foreach ($info_msg as $info_msg){
            echo '<script> swal("'.$info_msg.' ","","sucess"); </script>';
        }
    }
    if(isset($error_msg)){
        foreach ($error_msg as $error_msg){
            echo '<script> swal("'.$error_msg.' ","","sucess"); </script>';
        }
    }
?>