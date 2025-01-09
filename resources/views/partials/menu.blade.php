<!-- <nav class="bg-blue-900 p-4 rounded-lg shadow-md">
    <ul class="flex space-x-8">
        <li>
            <a href="/" class="text-white hover:text-gray-300 transition duration-200">Inici</a>
        </li>
        <li>
            <a href="/equips" class="text-white hover:text-gray-300 transition duration-200">Guia d'Equips</a>
        </li>
        <li>
            <a href="/estadis" class="text-white hover:text-gray-300 transition duration-200">Llistat d'Estadis</a>
        </li>
        <li>
            <a href="/jugadors" class="text-white hover:text-gray-300 transition duration-200">Llistat de Jugadores</a>
        </li>
        <li>
            <a href="/partits" class="text-white hover:text-gray-300 transition duration-200">Llistat de Partits</a>
        </li>
    </ul>
</nav> -->


<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('equips.index')" :active="request()->routeIs('equips.index')">
        {{ __('Guia Equips') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('estadis.index')" :active="request()->routeIs('estadis.index')">
        {{ __('Estadis') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('jugadors.index')" :active="request()->routeIs('jugadors.index')">
        {{ __('Llistat de Jugadores') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('partits.historic')" :active="request()->routeIs('partits.historic')">
        {{ __('Històric Partits') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('partits.index')" :active="request()->routeIs('partits.index')">
        {{ __('Llistat de Partits') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('calendaris.index')" :active="request()->routeIs('calendaris.index')">
        {{ __('Calendari') }}
    </x-nav-link>
</div>
<div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
    <x-nav-link :href="route('partits.classificacio')" :active="request()->routeIs('partits.classificacio')">
        {{ __('Classificació') }}
    </x-nav-link>
</div>