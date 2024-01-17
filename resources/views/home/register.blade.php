<section class="register">
    <div class="row">
        <div class="col-md-12">
            <div class="logo">
                <img src="{{ asset('image/luckydraw-images-02.png') }}" width="300px" height="100%" />
            </div>

            <div class="">
                <div class="mb-3 form-group">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        oninput="$(this).hasClass('is-invalid') ? $(this).removeClass('is-invalid'): ''">
                </div>

                <div class="mb-3 form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        oninput="$(this).hasClass('is-invalid') ? $(this).removeClass('is-invalid'): ''">
                </div>
                <div class="mb-3 form-group">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        oninput="$(this).hasClass('is-invalid') ? $(this).removeClass('is-invalid'): ''">
                </div>
            </div>
        </div>
    </div>
</section>