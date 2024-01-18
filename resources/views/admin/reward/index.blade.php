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
                           Tên shop: {{$key}}
                        </h3>
                            @foreach($group as $item)
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-0 text-center">
                                            <image src="{{ asset($item->images) }}" width="150" height="150">
                                                <div class="mt-3 d-flex flex-row">
                                                    <input type="number" class="form-control"
                                                        id="reward_quantity_{{ $item->id }}"
                                                        value="{{ $item->reward_quantity }}"
                                                        style="width:50%;height: 45px;">

                                                    <button class="btn btn-success mx-1"
                                                        onclick="updateRewardQuantity({{ $item->id }})"
                                                        style="width:50%;height: 45px;">Cập nhật</button>
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
                        <a href="{{ route('admin.index') }}" class="btn btn-info"
                        style="border-radius: 10px"
                        >Return</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function updateRewardQuantity(id) {
        var reward_quantity = $('#reward_quantity_' + id).val();
        $.ajax({
            url: "{{ route('admin.reward.update') }}",
            method: "POST",
            data: {
                id: id,
                reward_quantity: reward_quantity,
                _token: "{{ csrf_token() }}"
            },
            success: function(data) {
                window.location.reload();
            }
        });
    }
</script>
