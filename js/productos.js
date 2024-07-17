document.addEventListener('DOMContentLoaded', () => {
    const marcaSelect = document.getElementById('marcaSelect');
    const sensorSelect = document.getElementById('sensorSelect');
    const productosContainer = document.getElementById('productosContainer');

    const fetchOptions = async () => {
        try {
            console.log('Fetching options...');
            let response = await fetch('php/marcasysensores.php'); 
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            let data = await response.json();
            console.log('Data fetched:', data);

            data.marcas.forEach(marca => {
                let option = document.createElement('option');
                option.value = marca.id;
                option.textContent = marca.nombre;
                marcaSelect.appendChild(option);
            });

            data.sensores.forEach(sensor => {
                let option = document.createElement('option');
                option.value = sensor.id;
                option.textContent = `${sensor.nombre} ($${sensor.precio})`;
                sensorSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error fetching options:', error);
        }
    };

    const fetchProductos = async () => {
        try {
            console.log('Fetching productos...');
            let marcaId = marcaSelect.value;
            let sensorId = sensorSelect.value;
            let query = `?marca_id=${marcaId}&sensor_id=${sensorId}`;
            let response = await fetch('php/productos.php' + query); // Ruta correcta
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            let productos = await response.json();
            console.log('Productos fetched:', productos);

            productosContainer.innerHTML = '';

            if (productos.length > 0) {
                productos.forEach(producto => {
                    let productoDiv = document.createElement('div');
                    productoDiv.classList.add('producto');
                    productoDiv.innerHTML = `
                    <div class="producto-imagen">
                            <img src="imagenes/${producto.imagen}" alt="${producto.marca} - ${producto.sensor}">
                        </div>
                        <div class="producto-info">
                        <h3>${producto.marca} - ${producto.sensor}</h3>
                        <p>Precio: $${producto.precio}</p>
                        </div>
                    `;
                    productosContainer.appendChild(productoDiv);
                });
            } else {
                productosContainer.innerHTML = '<p>No se encontraron productos para los filtros seleccionados.</p>';
            }
        } catch (error) {
            console.error('Error fetching productos:', error);
        }
    };

    marcaSelect.addEventListener('change', fetchProductos);
    sensorSelect.addEventListener('change', fetchProductos);

    fetchOptions();
});
