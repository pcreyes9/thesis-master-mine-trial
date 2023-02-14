<div class="mt-5 intro-y flex justify-end gap-2">
    <button wire:click="selectItem({{$order_id}},'reject')" class="btn btn-danger">
        Reject
    </button>
    <button wire:click="selectItem({{$order_id}},'approved')" class="btn btn-primary">
        Approve
    </button>
</div>
