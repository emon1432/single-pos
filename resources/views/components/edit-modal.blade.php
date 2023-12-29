@props([
    'title' => '',
    'sizeClass' => 'modal-md',
    'id' => '',
])
    <div class="modal modal-danger fade" id="editModal-{{$id}}" tabindex="-1" role="dialog" aria-labelledby="Delete"
        aria-hidden="true">
        <div class="modal-dialog {{ $sizeClass }}" role="document">
            <div class="px-4 modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $title }}</h5>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
                    <button id="Update" type="submit" class="btn btn-success update">Update</button>
                </div>
            </div>
        </div>
    </div>