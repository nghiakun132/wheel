@extends('layouts')
@section('content')
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-xl-12 col-xxl-12 d-flex">
                <div class="w-100">
                    <h4>
                        Nhập số lượng quà tặng thêm
                    </h4>
                    <div class="row mt-4">
                        @foreach ($rewards as $key => $group)
                            <h3>
                                Tên shop: <b>{{ $key }}</b> <button class="btn btn-success mx-1"
                                    onclick="updateRewardQuantity('{{ $key }}')" >Cập
                                    nhật</button>
                            </h3>
                            @foreach ($group as $item)
                                <div class="col-sm-3">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="mb-0 text-center">
                                                <img src="{{ asset($item->images) }}" height="100" />
                                                    <div class="mt-3 d-flex flex-row">
                                                        <input type="number" class="form-control"
                                                            name="reward_quantity[{{ $key }}]"
                                                            id="reward_quantity_{{ $item->id }}"
                                                            value="{{ $item->reward_quantity }}" style="">

                                                        <input type="hidden" name="id" value="{{ $item->id }}" />

                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

                    <div class="row">
                        <a href="{{ route('admin.index') }}" class="btn btn-info" style="border-radius: 10px">Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function updateRewardQuantity(key) {
        
        let quantity = document.getElementsByName('reward_quantity[' + key + ']');

        const listQuantity = [];

        quantity.forEach((item) => {
            listQuantity.push({
                id: item.id.split('_')[2],
                quantity: item.value
            });
        });

        $.ajax({
            url: "{{ route('admin.reward.update') }}",
            method: "POST",
            data: {
                key: key,
                quantity: listQuantity,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                if (data.status == 'success') {
                    swal({
                        type: 'success',
                        title: "Cập nhật thành công!",
                    })
                }
            },
            error: function(data) {
                    swal({
                        type: 'error',
                        title: "Cập nhật thất bại!",
                        // 'html': 'Cập nhật thành công!'
                    })
            }
        });
    }
</script>
