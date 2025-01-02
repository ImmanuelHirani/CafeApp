<div class="grid grid-cols-8 gap-4 mt-4 dashboard">
    <div class="flex flex-col w-full h-full col-span-2 gap-3 p-4 bg-white rounded-lg">
        <div class="flex items-center gap-4 head">
            <i class="p-2.5 text-2xl rounded-md bg-secondary-color-admin ti ti-shopping-cart"></i>
            <p class="text-lg font-semibold">Orders</p>
        </div>
        <div class="grid w-full grid-cols-2 gap-4 h-fit body-content">
            <div class="w-full h-full p-3 space-y-2 rounded-lg wrap bg-secondary-color-admin">
                <p class="text-2xl font-semibold text-center">{{ $inProgressOrders }}</p>
                <div class="w-fit px-3.5 py-2 font-semibold mx-auto text-center bg-[#D9F8F6] rounded-full badge">
                    In Progress
                </div>
            </div>
            <div class="w-full h-full p-3 space-y-2 rounded-lg wrap bg-secondary-color-admin">
                <p class="text-2xl font-semibold text-center">{{ $completedOrders }}</p>
                <div class="w-fit px-3.5 py-2 font-semibold mx-auto text-center bg-[#E7FBE3] rounded-full badge">
                    Order Finish
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col w-full h-full col-span-2 gap-3 p-4 bg-white rounded-lg">
        <div class="flex items-center gap-4 head">
            <i class="ti ti-credit-card p-2.5 text-2xl rounded-md bg-secondary-color-admin"></i>
            <p class="text-lg font-semibold">Payments</p>
        </div>
        <div class="grid w-full grid-cols-2 gap-4 h-fit body-content">
            <div class="w-full h-full p-3 space-y-2 rounded-lg wrap bg-secondary-color-admin">
                <p class="text-2xl font-semibold text-center">{{ $pendingOrders }}</p>
                <div class="w-fit px-3.5 py-2 font-semibold mx-auto text-center bg-[#FDF6DF] rounded-full badge">
                    Pending
                </div>
            </div>
            <div class="w-full h-full p-3 space-y-2 rounded-lg wrap bg-secondary-color-admin">
                <p class="text-2xl font-semibold text-center">{{ $paidOrders }}</p>
                <div class="w-fit px-3.5 py-2 font-semibold mx-auto text-center bg-[#E7FBE3] rounded-full badge">
                    Paid
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col w-full h-full col-span-2 gap-3 p-4 bg-white rounded-lg">
        <div class="flex items-center gap-4 head">
            <i class="ti ti-moneybag p-2.5 text-2xl rounded-md bg-secondary-color-admin"></i>
            <p class="text-lg font-semibold">Income</p>
        </div>
        <div class="w-full h-fit body-content">
            <div class="w-full h-full p-3 space-y-2 rounded-lg wrap bg-secondary-color-admin">
                <p class="text-2xl font-semibold text-center">Rp.{{ number_format($totalIncome, 0, ',', '.') }}</p>
                <div class="w-fit px-3.5 py-2 font-semibold mx-auto text-center bg-[#D9F8F6] rounded-full badge">
                    Total incomes
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col w-full h-full col-span-2 gap-3 p-4 bg-white rounded-lg">
        <div class="flex items-center gap-4 head">
            <i class="ti ti-user p-2.5 text-2xl rounded-md bg-secondary-color-admin"></i>
            <p class="text-lg font-semibold">Customers</p>
        </div>
        <div class="w-full gap-4 h-fit body-content">
            <div class="w-full h-full p-3 space-y-2 rounded-lg wrap bg-secondary-color-admin">
                <p class="text-2xl font-semibold text-center">{{ $totalCustomers }}</p>
                <div class="w-fit px-3.5 py-2 font-semibold mx-auto text-center bg-[#E7FBE3] rounded-full badge">
                    Registered
                </div>
            </div>
        </div>
    </div>
</div>
