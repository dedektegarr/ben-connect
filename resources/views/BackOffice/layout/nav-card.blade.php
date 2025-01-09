<div class="fixed-bottom mb-5">
    <div class="row container mx-auto">
        <div class="col-md-2">
            <a class="link-offset-2 link-underline link-underline-opacity-0" href="{{ url('/admin/infrastruktur') }}">
                <div
                    class="card up-to-front {{ request()->is('admin/infrastruktur') ? 'active-card-light' : 'card-light' }}">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('assets/Icon-1.png') }}" alt="instance" style="width: 70px;" />
                            <h6>Infrastruktur</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a class="link-offset-2 link-underline link-underline-opacity-0" href="{{ url('/admin/pendidikan') }}">
                <div
                    class="card up-to-front {{ request()->is('admin/pendidikan') ? 'active-card-light' : 'card-light' }}">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('assets/Icon-2.png') }}" alt="instance" style="width: 70px;" />
                            <h6>Pendidikan</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a class="link-offset-2 link-underline link-underline-opacity-0" href="{{ url('/admin/kesehatan') }}">
                <div
                    class="card up-to-front @if (request()->is('admin/kesehatan') || request()->is('admin/kesehatan-maps')) active-card-light @else card-light @endif ">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('assets/Icon-3.png') }}" alt="instance" style="width: 70px;" />
                            <h6>Kesehatan</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a class="link-offset-2 link-underline link-underline-opacity-0" href="{{ url('/admin/komoditas') }}">
                <div
                    class="card up-to-front {{ request()->is('admin/komoditas') ? 'active-card-light' : 'card-light' }}">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('assets/Icon-4.png') }}" alt="instance" style="width: 70px;" />
                            <h6>Komoditas</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a class="link-offset-2 link-underline link-underline-opacity-0" href="{{ url('/admin/bencana') }}">
                <div
                    class="card up-to-front {{ request()->is('admin/bencana') ? 'active-card-light' : 'card-light' }}">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('assets/Icon-5.png') }}" alt="instance" style="width: 70px;" />
                            <h6>Rawan Bencana</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-2">
            <a class="link-offset-2 link-underline link-underline-opacity-0" href="{{ url('/admin/kependudukan') }}">
                <div
                    class="card up-to-front {{ request()->is('admin/kependudukan') ? 'active-card-light' : 'card-light' }}">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('assets/Icon-6.png') }}" alt="instance" style="width: 70px;" />
                            <h6>Sosial</h6>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
