<x-index-layout>
    <!------------------------- Cuadro de Busqueda --------------------------->
    <div class="container mb-4">
        <div class="card p-3">
            <form method="GET" action="{{ route('index') }}" class="row g-2 align-items-center">
                <div class="col-12 col-md-auto">
                    <label for="filter" class="form-label">Search by:</label>
                </div>
                <div class="col-12 col-md-auto">
                    <select name="filter" id="filter" class="form-select">
                        <option value="name" {{ request('filter') == 'name' ? 'selected' : '' }}>Name</option>
                        <option value="breed_group" {{ request('filter') == 'breed_group' ? 'selected' : '' }}>Breed Group</option>
                    </select>
                </div>
                <div class="col-12 col-md-auto flex-grow-1">
                    <input type="text" name="query" class="form-control" placeholder="Enter search term" value="{{ request('query') }}">
                </div>
                <div class="col-12 col-md-auto">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </form>
        </div>
    </div>
    <!------------------------------------------------------------------------>

    <!--------------------------- Lista de Razas ----------------------------->
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
                                <p><strong>Temperament:</strong> {{ $breed->temperament ?? 'Not available' }}</p>
                                <p><strong>Origin:</strong> {{ $breed->origin ?? 'Unknown' }}</p>
                                <p><strong>Life span:</strong> {{ $breed->life_span ?? 'N/A' }}</p>
                                <p><strong>Weight:</strong> {{ $breed->weight_metric ?? 'N/A' }} kg</p>
                                <p><strong>Height:</strong> {{ $breed->height_metric ?? 'N/A' }} cm</p>
                                <button type="button" class="btn btn-sm btn-outline-primary ms-auto" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#breedModal"
                                    data-breed='@json($breed)'>
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!------------------------------------------------------------------------>

    <div class="d-flex justify-content-center">
        {{ $razas->links() }}
    </div>
    
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