    <!-- Delete Modal -->
    <div class="modal fade" id="close{{ $trip->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">@lang('dashboard.change_status_booking')</h3>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('toggle.status.booking' , $trip->id ) }}" method="post">
                    @csrf
                    <div class="modal-body ">
                        <div class="row-auto">
                            <div class="form-group">
                                @if($trip->status_booking == 'available_booking')
                                    <label for="id">@lang('dashboard.do_sure_close_booking')</label>
                                    <input type="text"  value="{{ $trip->title }} - {{ $trip->company->title }}" readonly class="form-control" id="id"><br>
                                @elseif ($trip->status_booking == 'close_booking')
                                    <label for="id">@lang('dashboard.do_sure_available_booking')</label>
                                    <input type="text"  value="{{ $trip->title }} - {{ $trip->company->title }}" readonly class="form-control" id="id"><br>
                                @else
                                    <label for="id">@lang('dashboard.complete_status')</label>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if($trip->status_booking == 'available_booking' || $trip->status_booking == 'close_booking')
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('site.close')</button>
                            <button type="submit" class="btn btn-danger">@lang('site.confirm')</button>
                        @else
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('site.close')</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
