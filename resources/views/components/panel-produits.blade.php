<div class="panel-options d-flex flex-row justify-content-center" style="width: 100%;">
    @if ($active == "ajouterProduits")
    <a class="text-decoration-none mx-1">
        <div class="container py-3 panel-option-active">
    @else
    <a href="/panel/ajouterProduits" class="text-decoration-none">
        <div class="container py-3 panel-option">
    @endif
            <span class="fs-5 text-break">Ajouter</span>
        </div>
    </a>
    @if ($active == "modifierProduits")
    <a class="text-decoration-none mx-1">
        <div class="container py-3 panel-option-active">
    @else
    <a href="/panel/modifierProduits" class="text-decoration-none">
        <div class="container py-3 panel-option">
    @endif
            <span class="fs-5 text-break">Modifier</span>
        </div>
    </a>
    @if ($active == "enleverProduits")
    <a class="text-decoration-none mx-1">
        <div class="container py-3 panel-option-active">
    @else
    <a href="/panel/enleverProduits" class="text-decoration-none">
        <div class="container py-3 panel-option">
    @endif
            <span class="fs-5 text-break">Enlever</span>
        </div>
    </a>
</div>