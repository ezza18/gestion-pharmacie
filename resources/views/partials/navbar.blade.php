<style>
    * { box-sizing: border-box; }
    body { margin: 0; font-family: 'Segoe UI', Arial, sans-serif; background: #f5f6fa; }
    .layout { display: flex; min-height: 100vh; }
    .sidebar { width: 240px; background: #1a2332; color: white; padding: 20px 0; flex-shrink: 0; }
    .sidebar .logo { padding: 0 20px 20px 20px; font-weight: bold; font-size: 18px; border-bottom: 1px solid #2c3a4f; margin-bottom: 20px; }
    .sidebar a { display: flex; align-items: center; gap: 10px; padding: 12px 20px; color: #b8c2cc; text-decoration: none; font-size: 14px; }
    .sidebar a:hover, .sidebar a.active { background: #2563eb; color: white; }
    .main-content { flex: 1; padding: 30px; }
</style>
<div class="layout">
    <div class="sidebar">
        <div class="logo">🏥 Gestion Pharmacie</div>
        <a href="{{ url('/produits') }}">📦 Produits</a>
        <a href="{{ url('/ventes') }}">💰 Ventes</a>
        <a href="{{ url('/achats') }}">🛒 Achats</a>
        <a href="{{ url('/finance') }}">📊 Finance</a>
    </div>
    <div class="main-content">