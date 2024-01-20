<section class="register">
    <div class="row">
        <div class="col-md-12">
            <div class="logo">
                <img src="{{ asset('image/luckydraw-images-02.png') }}" width="70%"  />
            </div>

            <div class="">
                <div class="mb-3 form-group">
                    <label for="name" class="form-label fw-bold">Họ & tên</label>
                    <input type="text" class="form-control" id="name" name="name"
                        oninput="$(this).hasClass('is-invalid') ? $(this).removeClass('is-invalid'): ''">
                </div>

                <div class="mb-3 form-group">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        oninput="$(this).hasClass('is-invalid') ? $(this).removeClass('is-invalid'): ''">
                </div>
                <div class="mb-3 form-group">
                    <label for="phone" class="form-label fw-bold">Số điện thoại</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        oninput="$(this).hasClass('is-invalid') ? $(this).removeClass('is-invalid'): ''">
                </div>
                <div class="mb-3 form-group">
                    <label for="phone" class="form-label fw-bold">Năm sinh</label>
                    <input type="number" class="form-control" id="age" name="age"
                        oninput="$(this).hasClass('is-invalid') ? $(this).removeClass('is-invalid'): ''">
                </div>
                <div class="mb-3 form-group">
                    <label for="phone" class="form-label fw-bold">Giới tính</label>
                    <select name="sex" id="sex" class="form-control"
                        onchange="$(this).hasClass('is-invalid') ? $(this).removeClass('is-invalid'): ''">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                        <option value="Khác">Khác</option>
                    </select>
                </div>
              
                <input type="hidden" name="shop_name" value="{{auth()->user()->name}}">
            </div>
        </div>
    </div>
</section>
<style>
</style>