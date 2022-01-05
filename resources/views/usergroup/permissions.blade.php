<hr>
<div class="row">
  <div class="col-sm-3">
      <legend class="col-form-label pt-2">Users</legend>
        @foreach ($userPermission as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module }}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
    {{-- </div>
    <div class="row mb-3"> --}}
      <div class="col-sm-3">
      <legend class="col-form-label pt-2">User Group</legend>
        @foreach ($userGroupPermission as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module }}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
</div>