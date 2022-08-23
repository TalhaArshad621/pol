<hr>
<div class="row">
  <div class="col-sm-3">
      <legend class="col-form-label pt-2">Users</legend>
        @foreach ($userPermission as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input {{ $permission->module . 'Edit'}}" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module . 'Edit'}}[]" 
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
          class="form-check-input {{ $permission->module . 'Edit'}}" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module . 'Edit'}}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
      <div class="col-sm-3">
      <legend class="col-form-label pt-2">Patient</legend>
        @foreach ($patient as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input {{ $permission->module . 'Edit'}}" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module . 'Edit'}}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
      <div class="col-sm-3">
      <legend class="col-form-label pt-2">Hospital Request</legend>
        @foreach ($hospitalRequest as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input {{ $permission->module . 'Edit'}}" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module . 'Edit'}}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
      <div class="col-sm-3">
      <legend class="col-form-label pt-2">Blood Bag</legend>
        @foreach ($bloodBag as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input {{ $permission->module . 'Edit'}}" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module . 'Edit'}}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
      <div class="col-sm-3">
      <legend class="col-form-label pt-2">Donator</legend>
        @foreach ($donator as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input {{ $permission->module . 'Edit'}}" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module . 'Edit'}}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
      <div class="col-sm-3">
      <legend class="col-form-label pt-2">Donation</legend>
        @foreach ($donation as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input {{ $permission->module . 'Edit'}}" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module . 'Edit'}}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
    <div class="col-sm-3">
      <legend class="col-form-label pt-2">Donation Request</legend>
        @foreach ($donationRequest as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input {{ $permission->module . 'Edit'}}" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module . 'Edit'}}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
    <div class="col-sm-3">
      <legend class="col-form-label pt-2">Campaign</legend>
        @foreach ($campaign as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input {{ $permission->module . 'Edit'}}" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module . 'Edit'}}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
    <div class="col-sm-3">
      <legend class="col-form-label pt-2">Report</legend>
        @foreach ($report as $key => $permission )
      <div class="form-check">
          <input 
          class="form-check-input {{ $permission->module . 'Edit'}}" 
          type="checkbox" 
          id="{{ $permission->module }}" 
          name="{{ $permission->module . 'Edit'}}[]" 
          value="{{ $permission->id }}"
          >
          <label class="form-check-label" for="userPermission">
            {{ $permission->slug }}
          </label>
        </div>
        @endforeach
    </div>
</div>