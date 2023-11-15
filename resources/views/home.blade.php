@extends('layouts.app')

@section('content')
<div class="container p-5">
    <div class="row">
        <div class="col col-md-12">
            <div class="card shadow-lg p-3 mb-5 bg-body rounded">



                <div class="card-body">
                    <h5 class="card-title">Conversor de monedas</h5>
                    <form action="{{ route('convert_currencies') }}" method="POST">
                        <div class="row">
                            @csrf
                            <div class="col col-2">
                                <div class="mb-3">
                                    <label for="monto" class="form-label">Importe</label>
                                    <input type="number" min="0" step="0.01" class="form-control" id="monto"
                                        name="importe" placeholder="1,00" value="20">
                                </div>
                            </div>
                            <div class="col col-4">
                                <label for="moneda_base" class="form-label">De:</label>

                                <select id="moneda_base" class="form-select" name="moneda_base">
                                    @isset($result['moneda_base'])

                                    @forelse ($data['currencies'] as $acronimo => $divisa)

                                    @if ($acronimo == $result['moneda_base'])

                                    <option value="{{ $acronimo }}" selected>{{ $acronimo." - ".$divisa}}</option>

                                    @else

                                    <option value="{{ $acronimo }}">{{ $acronimo." - ".$divisa }}</option>

                                    @endif

                                    @empty
                                    "No se obtuvieron los satos"
                                    @endforelse
                                    @else
                                    @forelse ($data['currencies'] as $acronimo => $divisa)
                                    @if ($acronimo == 'USD')
                                    <option value="{{ $acronimo }}" selected>{{ $acronimo." - ".$divisa}}

                                    </option>
                                    @else
                                    <option value="{{ $acronimo }}">{{ $acronimo." - ".$divisa }}
                                    </option>
                                    @endif

                                    @empty
                                    "No se obtuvieron los satos"
                                    @endforelse
                                    @endisset


                                </select>

                            </div>
                            <div class="col col-4">
                                <label for="moneda_destino" class="form-label">Convertir a :</label>

                                <select id="moneda_destino" class="form-select" name="moneda_destino">
                                    @isset($result['moneda_destino'])

                                    @forelse ($data['currencies'] as $acronimo => $divisa)

                                    @if ($acronimo == $result['moneda_destino'])

                                    <option value="{{ $acronimo }}" selected>{{ $acronimo." - ".$divisa}}</option>

                                    @else

                                    <option value="{{ $acronimo }}">{{ $acronimo." - ".$divisa }}</option>

                                    @endif

                                    @empty
                                    "No se obtuvieron los satos"
                                    @endforelse
                                    @else
                                    @forelse ($data['currencies'] as $acronimo => $divisa)
                                    @if ($acronimo == 'EUR')
                                    <option value="{{ $acronimo }}" selected>{{ $acronimo." - ".$divisa}}

                                    </option>
                                    @else
                                    <option value="{{ $acronimo }}">{{ $acronimo." - ".$divisa }}
                                    </option>
                                    @endif

                                    @empty
                                    "No se obtuvieron los satos"
                                    @endforelse
                                    @endisset


                                </select>

                            </div>
                            <div class="col col-2">
                                <div class="mb-3  mt-2">
                                    <label for="monto" class="form-label"></label>
                                    <button type="submit" class="btn btn-primary form-control">Convertir</button>

                                </div>
                            </div>

                        </div>
                    </form>
                    <div class="row">
                        <div class="col col-4">
                            <div class="mb-3">

                                <label for="total_convertido" class="form-label">Total convertido</label>
                                <input type="number" min="0" step="0.01" class="form-control" id="total_convertido"
                                    name="total_convertido" placeholder="1,00 " value="{{ $result['conversion']??0 }}">
                            </div>
                        </div>
                        <div class="col col-4">
                            <label for="tasa_utilizada" class="form-label">Tasa utilizada</label>

                            <input type="text" class="form-control" id="tasa_utilizada" name="tasa_utilizada"
                                placeholder="{{ $result['precio_base']??" 1" }} {{ $result['moneda_base'] ??'USD' }} ->
                            {{ $result['precio']??'' }} {{ $result['moneda_destino']??'EUR' }}"
                            value="{{ $result['precio_base']??'1' }} {{ $result['moneda_base'] ??'USD' }} -> {{
                            $result['precio_destino']??'0.919784' }} {{ $result['moneda_destino']??'EUR' }}">

                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
