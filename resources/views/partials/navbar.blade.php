<style>
    .navbar { background: #2c3e50; padding: 15px 30px; margin: -40px -40px 30px -40px; }
    .navbar a { color: white; text-decoration: none; margin-right: 20px; font-weight: bold; }
    .navbar a:hover { color: #3498db; }
</style>
<div class="navbar">
    <a href="{{ url('/produits') }}">📦 Produits</a>
    <a href="{{ url('/ventes') }}">💰 Ventes</a>
    <a href="{{ url('/achats') }}">🛒 Achats</a>
    <a href="{{ url('/finance') }}">📊 Finance</a>
</div>