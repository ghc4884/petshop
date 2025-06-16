<x-index-layout>

    <!------------------------------ Mision ---------------------------------->
    <div class="bg-warning text-center py-5">
        <h2 class="fw-bold mb-4">Nuestra misión</h2>
        <p class="mx-auto" style="max-width: 800px;">
            Queremos ayudarte a brindarle a tu mascota la mejor calidad de vida. En nuestra opinión, 
            la mejor manera de hacerlo es ver el mundo como lo ve tu mascota. Adoptamos este enfoque 
            para todo, desde alimentos y refrigerios hasta juguetes, ropa de cama y otros accesorios. 
            Cada artículo que ofrecemos es algo que le daríamos a nuestras propias mascotas con amor y cuidado.
        </p>
    </div>
    <!------------------------------------------------------------------------>

    <!------------------------------ Clientes -------------------------------->
    <div class="container py-4">
        <h2 class="text-center mb-4">Nuestros Clientes Felices 🐶</h2>

        <div class="row">
            @foreach ($imagenes as $img)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm">
                        <img src="{{ $img['url'] }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Dog Image">
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <!------------------------------------------------------------------------>

    <!------------------------------ Testimonio ------------------------------>
    <div class="container my-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="fs-5">
                    Los perros son mis mejores amigos, mis confidentes, mi inspiración. No puedo imaginarme comenzar el día acurrucándome con mi perro Charlie.
                </p>
                <p class="fw-bold mb-0">Coopropietario</p>
                <p class="fs-4 fw-bold">Kira Petrova</p>
            </div>
            <div class="col-md-6 text-center">
                <img src="{{ $img['url'] }}" alt="Kira Petrova" class="rounded-circle img-fluid" style="max-width: 350px; object-fit: cover;">
            </div>
        </div>
    </div>
    <!------------------------------------------------------------------------>

    <!------------------------------ Encuentra ------------------------------->
    <div class="card my-5 shadow">
        <div class="card-body">
            <h2 class="text-center text-success mb-4">Conoce a tu mascota ideal</h2>
            <p class="text-center text-muted mb-4">
                Explora diferentes razas de perros, conoce sus características y encuentra a tu compañero ideal.
            </p>

            <!------------------------- Cuadro de Búsqueda ------------------------->
            <div class="container mb-4">
                <div class="card p-3">
                    <form method="GET" action="{{ route('index') }}" class="row g-2 align-items-center">
                        <div class="col-12 col-md-auto">
                            <label for="filter" class="form-label">Buscar por:</label>
                        </div>
                        <div class="col-12 col-md-auto">
                            <select name="filter" id="filter" class="form-select">
                                <option value="name" {{ request('filter') == 'name' ? 'selected' : '' }}>Nombre</option>
                                <option value="breed_group" {{ request('filter') == 'breed_group' ? 'selected' : '' }}>Grupo de raza</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-auto flex-grow-1">
                            <input type="text" name="query" class="form-control" placeholder="Escribe un término" value="{{ request('query') }}">
                        </div>
                        <div class="col-12 col-md-auto">
                            <button type="submit" class="btn btn-primary w-100">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
            <!------------------------------------------------------------------------>

            <!-------------------------- Lista de Razas ----------------------------->
            <div class="row">
                @foreach ($razas as $index => $breed)
                    <div class="col-sm-12 col-md-4 p-3">
                        <div class="accordion" id="accordionBreeds">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $index }}">
                                    <button class="accordion-button collapsed d-flex align-items-center gap-3" type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapse{{ $index }}"
                                            aria-expanded="false"
                                            aria-controls="collapse{{ $index }}">

                                        @if ($breed->reference_image_id)
                                            <img src="https://cdn2.thedogapi.com/images/{{ $breed->reference_image_id }}.jpg"
                                                alt="{{ $breed->name }}"
                                                width="60" height="60"
                                                style="object-fit: cover; border-radius: 5px;">
                                        @endif

                                        <span>{{ $breed->name }}</span>
                                    </button>
                                </h2>

                                <div id="collapse{{ $index }}"
                                        class="accordion-collapse collapse"
                                        aria-labelledby="heading{{ $index }}"
                                        data-bs-parent="#accordionBreeds">
                                    <div class="accordion-body">
                                        <p><strong>Temperamento:</strong> {{ $breed->temperament ?? 'No disponible' }}</p>
                                        <p><strong>Origen:</strong> {{ $breed->origin ?? 'Desconocido' }}</p>
                                        <p><strong>Esperanza de vida:</strong> {{ $breed->life_span ?? 'N/A' }}</p>
                                        <p><strong>Peso:</strong> {{ $breed->weight_metric ?? 'N/A' }} kg</p>
                                        <p><strong>Altura:</strong> {{ $breed->height_metric ?? 'N/A' }} cm</p>
                                        <button type="button" class="btn btn-sm btn-outline-primary ms-auto" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#breedModal"
                                            data-breed='@json($breed)'>
                                            Ver detalles
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!------------------------------------------------------------------------>

            <!----------------------------- Paginado -------------------------------->
            <div class="d-flex justify-content-center mt-4">
                {{ $razas->links() }}
            </div>
            <!------------------------------------------------------------------------>
        </div>
    </div>
    <!------------------------------------------------------------------------>

    <!------------------------------ Porque ---------------------------------->
    <div class="py-5" style="background-color: #fff9c4;">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Porque los dueños de mascotas nos aman</h2>
            <p class="fs-5">
            <span class="fw-bold me-3">Calidad</span>
            <span class="fw-bold me-3">Precios Justos</span>
            <span class="fw-bold me-3">Transparencia</span>
            <span class="fw-bold">Negocio Familiar</span>
            </p>
        </div>
    </div>
    <!------------------------------------------------------------------------>
    <br>
    <!------------------------------ Instagram ------------------------------->
    <div class="py-5 bg-light">
        <div class="container text-center">
            <h2 class="fw-bold mb-4">Síguenos en Instagram</h2>
            <div class="row justify-content-center g-3">
            <div class="row">
                @foreach ($imagenes2 as $img)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card shadow-sm">
                            <img src="{{ $img['url'] }}" class="card-img-top" style="height: 250px; object-fit: cover;" alt="Dog Image">
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!------------------------------------------------------------------------>

    <!------------------------------- Modal ---------------------------------->
    <div class="modal fade" id="breedModal" tabindex="-1" aria-labelledby="breedModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="breedModalLabel">Breed Details</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="breedImage" src="" alt="Breed Image" 
                    class="img-fluid rounded-circle mx-auto d-block border border-4"
                    style="max-width: 350px; max-height: 350px; border-color: #198754; object-fit: cover;"
                >
                <br>
                <br>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Name:</strong> <span id="breedName"></span></li>
                    <li class="list-group-item"><strong>Temperament:</strong> <span id="breedTemperament"></span></li>
                    <li class="list-group-item"><strong>Origin:</strong> <span id="breedOrigin"></span></li>
                    <li class="list-group-item"><strong>Life Span:</strong> <span id="breedLifeSpan"></span></li>
                    <li class="list-group-item"><strong>Weight (metric):</strong> <span id="breedWeight"></span> kg</li>
                    <li class="list-group-item"><strong>Height (metric):</strong> <span id="breedHeight"></span> cm</li>
                    <li class="list-group-item"><strong>Bred for:</strong> <span id="breedBredFor"></span></li>
                    <li class="list-group-item"><strong>Breed Group:</strong> <span id="breedGroup"></span></li>
                </ul>
            </div>
        </div>
        </div>
    </div>
    <!------------------------------------------------------------------------>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var breedModal = document.getElementById('breedModal')
            breedModal.addEventListener('show.bs.modal', function (event) {
                // Botón que disparó el modal
                var button = event.relatedTarget
                // Datos de la raza
                var breed = button.getAttribute('data-breed')
                var data = JSON.parse(breed)
        
                // Actualizar contenido del modal
                breedModal.querySelector('#breedModalLabel').textContent = data.name || 'No name'
                breedModal.querySelector('#breedImage').src = data.reference_image_id ? `https://cdn2.thedogapi.com/images/${data.reference_image_id}.jpg` : ''
                breedModal.querySelector('#breedImage').alt = data.name || 'Breed image'
                breedModal.querySelector('#breedName').textContent = data.name || 'N/A'
                breedModal.querySelector('#breedTemperament').textContent = data.temperament || 'N/A'
                breedModal.querySelector('#breedOrigin').textContent = data.origin || 'Unknown'
                breedModal.querySelector('#breedLifeSpan').textContent = data.life_span || 'N/A'
                breedModal.querySelector('#breedWeight').textContent = (data.weight && data.weight.metric) || 'N/A'
                breedModal.querySelector('#breedHeight').textContent = (data.height && data.height.metric) || 'N/A'
                breedModal.querySelector('#breedBredFor').textContent = data.bred_for || 'N/A'
                breedModal.querySelector('#breedGroup').textContent = data.breed_group || 'N/A'
            })
        })
    </script>

</x-index-layout>