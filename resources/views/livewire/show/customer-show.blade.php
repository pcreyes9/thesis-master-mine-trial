<div>
    <div class="grid grid-cols-12 gap-x-6 mt-5 pb-20">
        <div class="intro-y col-span-12">
            <!-- Begin: Product Information -->
            <div class="intro-y box p-5">
                <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                    <div class="font-medium text-base flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> {{ $name }}  </div>
                    <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Email Address</label>
                            <input type="text" class="form-control" wire:model="name" disabled>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label  class="form-label">Phone Number</label>
                            <input  type="email" class="form-control" wire:model="phone" disabled>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label  class="form-label">Gender</label>
                            <input  type="text" class="form-control" wire:model="gender" disabled>
                        </div>
                        <div class="intro-y col-span-12 sm:col-span-6">
                            <label class="form-label">Birthday</label>
                            <input type="text" class="form-control" wire:model="birthday" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
