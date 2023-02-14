@extends('customer.layout.base')
@section('content')
@section('title', 'Cart')

    <livewire:table.cart-table/>
    <livewire:modal.remove-product-cart/>
    <livewire:form.adjust-product-cart/>

@endsection
@push('scripts')
<script>
     //Delete Modal
     const RemoveToCartModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#delete-confirmation-modal"));
    //Show Delete Modal
    window.addEventListener('openRemoveModal',event => {
        RemoveToCartModal.show();
    });
    //Hide Delete Modal
    window.addEventListener('CloseDeleteModal',event => {
        RemoveToCartModal.hide();
    });
    //Hide Modal and Refresh its value
    const DeleteModal = document.getElementById('delete-confirmation-modal')
    DeleteModal.addEventListener('hidden.tw.modal', function(event) {
        livewire.emit('forceCloseModal');
    });
    //openAdjustModal
    //Delete Modal
    const AdjustCartModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#adjust-item-modal"));
        //Show Delete Modal
        window.addEventListener('openAdjustModal',event => {
            AdjustCartModal.show();
        });
        //Hide Delete Modal
        window.addEventListener('CloseAdjustModal',event => {
            AdjustCartModal.hide();
        });
        //Hide Modal and Refresh its value
        const AdjustModal = document.getElementById('adjust-item-modal')
        AdjustModal.addEventListener('hidden.tw.modal', function(event) {
            livewire.emit('forceCloseModal');
        });


        var inputBox = document.getElementById("adjustquantity");
        var invalidChars = [
          "e",
        ];

        inputBox.addEventListener("keydown", function(e) {
          if (invalidChars.includes(e.key)) {
            e.preventDefault();
          }
    });

</script>
@endpush
