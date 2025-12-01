
<x-qf::livewire.bootstrap.layouts.app>
    <x-slot name="topNav">
        <livewire:qf::layouts.navs.top-nav moduleName="admin">
    </x-slot>

    <x-slot name="sidebar">
        <livewire:qf::layouts.navs.sidebar context="Users & Permissions"  moduleName="admin">
    </x-slot>


   <livewire:admin.access-control-manager
        :selectedModule="$selectedModule?? null"
        :isUrlAccess="$isUrlAccess?? false"
        />

</x-qf::livewire.bootstrap.layouts.app>

