<link rel="stylesheet" href="/css/components/add_success.css">
<div class="add-success-modal" id="{{ $modalId }}" style="display:none;">
    <div class="add-success-content">
         <div class="mid-success-image">
                <img src="{{ asset('images/success.png') }}" alt="Mr. David" class="mid-photo">
            </div>
        <!-- <h4>{{ $title ?? 'Success' }}</h4> -->
        <p>{{ $message ?? 'Your action was successful!' }}</p>
        <div class="button-group">
            <x-button type="button" variant="primary" :id="$confirmId ?? 'confirmAddSuccessBtn'">OK</x-button>
        </div>
    </div>