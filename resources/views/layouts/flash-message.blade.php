@if(session('success-alert'))
<div aria-live="polite" aria-atomic="true" class="position-relative">
  <div class="toast-container top-0 end-0 p-3">
    <div class="toast border-0 bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <strong class="me-auto">Success</strong>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body bg-light">
        {{ session('success-alert')['message'] }}
      </div>
    </div>
  </div>
</div>
@endif
