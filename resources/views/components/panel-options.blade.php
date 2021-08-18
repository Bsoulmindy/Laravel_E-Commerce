<div class="panel-options d-flex flex-row justify-content-center" style="width: 100%;">
    @if ($active == "resultat")
    <a class="text-decoration-none mx-1">
        <div class="container py-3 panel-option-active">
    @else
    <a href="/panel/resultat" class="text-decoration-none">
        <div class="container py-3 panel-option">
    @endif
            <span class="fs-5 text-break">Résultat analytique</span>
        </div>
    </a>
    @if ($active == "stock")
    <a class="text-decoration-none mx-1">
        <div class="container py-3 panel-option-active">
    @else
    <a href="/panel/stock" class="text-decoration-none">
        <div class="container py-3 panel-option">
    @endif
            <span class="fs-5 text-break">Stock actuel</span>
        </div>
    </a>
    @if ($active == "utilisateurs")
    <a class="text-decoration-none mx-1">
        <div class="container py-3 panel-option-active">
    @else
    <a href="/panel/utilisateurs" class="text-decoration-none">
        <div class="container py-3 panel-option">
    @endif
            <span class="fs-5 text-break">Utilisateurs</span>
        </div>
    </a>
</div>