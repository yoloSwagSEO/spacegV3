<div class="row" id="rowBuilding">
    <div class="col-md-12 bgLR" id="labelshipyard">
        <p>Batiments</p>
        <div id="trie-button">
            <button class="all active">Tous</button>
            <button class="ressource">Ressources</button>
            <button class="militaire">Militaires</button>
            <button class="scientifique">Scientifiques</button>
            <button class="civil">Civils</button>
            <button class="exo">Exo-Structures</button>
        </div>
    </div>
    <div class="col-md-12 bgLR" id="list-bat">
        <form action="" method="post">
            <table>
                <tbody>
                <tr>
                    <td class="c" colspan="5">{Production_of_resources_in_the_planet}</td>
                </tr><tr>
                    <th height="22">&nbsp;</th>
                    <th width="60">{Metal}</th>
                    <th width="60">{Crystal}</th>
                    <th width="60">{Deuterium}</th>
                    <th width="60">{Energy}</th>
                </tr><tr>
                    <th height="22">{rs_basic_income}</th>
                    <td class="k">{metal_basic_income}</td>
                    <td class="k">{crystal_basic_income}</td>
                    <td class="k">{deuterium_basic_income}</td>
                    <td class="k">{energy_basic_income}</td>
                </tr>
                {resource_row}
                <tr>
                    <th height="22">{rs_storage_capacity}</th>
                    <td class="k">{metal_max}</td>
                    <td class="k">{crystal_max}</td>
                    <td class="k">{deuterium_max}</td>
                    <td class="k">-</td>
                    <td class="k"><input name="action" value="{rs_calculate}" type="submit"></td>
                </tr><tr>
                    <th height="22">{rs_sum}:</th>
                    <td class="k">{metal_total}</td>
                    <td class="k">{crystal_total}</td>
                    <td class="k">{deuterium_total}</td>
                    <td class="k">{energy_total}</td>
                </tr>
                <tr>
                    <th>{rs_daily}</th>
                    <th>{daily_metal}</th>
                    <th>{daily_crystal}</th>
                    <th>{daily_deuterium}</th>
                    <th>{energy_total}</th>
                </tr>
                <tr>
                    <th>{rs_weekly}</th>
                    <th>{weekly_metal}</th>
                    <th>{weekly_crystal}</th>
                    <th>{weekly_deuterium}</th>
                    <th>{energy_total}</th>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
</div>
<div id="content">

</div>