<section>
    <h3>Tracking de productos</h3>
    <div class="buscador">
        <input type="text" id="search" class="buscar" placeholder="Buscar">
        <i class="icon-search"></i>
    </div>
    <table>
        <thead class="thead">
            <tr>
                <th>Nombres</th>
                <th>Telefono</th>
                <th>Direccion</th>
                <th>Email</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Codigo</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody id="compras">
        </tbody>
    </table>
    <button onclick="obtenerc()">Refrescar</button>
</section>