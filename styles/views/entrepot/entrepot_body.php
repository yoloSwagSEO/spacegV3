<script src="js/pages/entrepots.js"></script>
<div class="row" id="rowBuilding">
    <div class="col-md-12 bgLR " id="labelshipyard">
        <p>Entrepots</p>
    </div>
    <div class="col-md-12 bgLR pd-10" id="buildlistingBatNew">
        <b>Metal: {ApourcentMetal}% - {metal}/{metalMax}</b>
        <div id="metal_entrepot">
            <div style="width:{pourcentMetal}%;height:16px;background:red;"></div>
        </div>
        <b>Cristal: {ApourcentCristal}% - {cristal}/{cristalMax}</b>
        <div id="cristal_entrepot">
            <div style="width:{pourcentCristal}%;height:16px;background:red;"></div>
        </div>
        <b>Uradium: {ApourcentDeut}% - {deut}/{deutMax}</b>
        <div id="uradium_entrepot">
            <div style="width:{pourcentDeut}%;height:16px;background:red;"></div>
        </div>
    </div>
    <div class="col-md-12 bgLR pd-10" id="list-bat">
        {item}
    </div>
</div>