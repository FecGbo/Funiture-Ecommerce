<link rel="stylesheet" href="/css/components/delete_form.css">

<div id="{{ $modalId }}" class="custom-modal" style="display:none;">
    <div class="custom-modal-content">
        <h4>{{ $title ?? 'Confirm Delete' }}</h4>
        <p>{{ $message ?? 'Are you sure you want to delete this item?' }}</p>
        <div style="display: flex; justify-content: flex-end; gap: 1rem;">
            <x-button type="button" variant="secondary" :id="$cancelId ?? 'cancelDeleteBtn'">Cancel</x-button>
            <x-button type="button" variant="danger" :id="$confirmId ?? 'confirmDeleteBtn'">Confirm</x-button>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Hide modal on cancel
        document.getElementById(@json($cancelId ?? 'cancelDeleteBtn')).addEventListener('click', function () {
            document.getElementById(@json($modalId)).style.display = 'none';
        });
        // Hide modal on outside click
        document.getElementById(@json($modalId)).addEventListener('click', function (e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });
        // Hide modal on ESC
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                document.getElementById(@json($modalId)).style.display = 'none';
            }
        });
        // Confirm button: submit form if formId is provided
        if (@json(isset($formId) ? $formId : false)) {
            document.getElementById(@json($confirmId ?? 'confirmDeleteBtn')).addEventListener('click', function () {
                document.getElementById(@json($formId)).submit();
            });
        }
    });
</script>