<link rel="stylesheet" href="/css/components/add_success.css">
<div class="add-success-modal" id="{{ $modalId }}" style="display:none;">
    <div class="add-success-content">
        <div class="mid-success-image">
            <img src="{{ asset('images/' . ($image ?? 'success.png')) }}" alt="Status" class="mid-photo">
        </div>
        <p class="add-success-message">{{ $message ?? 'Your action was successful!' }}</p>
        <div class="button-group">
            <x-button type="button" variant="primary" :id="$confirmId ?? 'confirmAddSuccessBtn'">OK</x-button>
        </div>
    </div>
</div>