<h4 class="alert alert-danger d-flex justify-content-between align-items-center mb-3">
    <strong>Invalid input</strong>
    <span class="badge badge-secondary badge-pill">{{ count($errors) }}</span>
</h4>
<ul class="list-group alert-danger">
    @foreach ($errors->all() as $error)
        <li class="list-group-item">{{ $error }}</li>
    @endforeach
</ul>