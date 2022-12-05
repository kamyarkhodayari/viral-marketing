@if (count($errors->all()) > 0)
    <div class="alert alert-danger d-flex justify-content-between">
        <ul class="list-unstyled mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="close align-self-center" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif