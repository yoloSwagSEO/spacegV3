<div class="row">
    <div class="col-md-12 bgLR bdDotted" id="actionColonyHeader">
        <p>Action sur la colonie ({planet_name} - {galaxy_galaxy}:{galaxy_system}:{galaxy_planet})</p>
    </div>
</div>
<div class="row">
    <div class="col-md-12 bgLR bdDotted" id="list-bat">
        <form action="game.php?page=overview&mode=renameplanet&pl={planet_id}" method="POST">
            <table width=519>
                <tr>
                    <th></th>
                    <th></th>
                    <th>{ov_actions}</th>
                </tr><tr>
                    <th></th>
                    <th></th>
                    <th><input type="submit" name="action" value="{ov_abandon_planet}"></th>
                </tr><tr>
                    <th>{ov_planet_rename}</th>
                    <th><input type="text" name="newname" size=25 maxlength=20></th>
                    <th><input type="submit" name="action" value="{ov_planet_rename_action}"></th>
                </tr>
            </table>
        </form>
    </div>
</div>