<div id="content">
    <div id="list-bat">
        <form action="" method="post">
            <table class="table table-striped">
                <tr>
                    <td class="c">Productions des batiments de la colonie</td>
                </tr>
                <tr>
                    <td>
                        <table class="table table-striped table-hover">
                            <tr>
                                <td colspan="2"></td>
                                <th>Etat</th>
                                <th>Metal</th>
                                <th>Cristal</th>
                                <th>Uradium</th>
                                <th>Cr&eacute;dits</th>
                                <th>Energie</th>
                            </tr>
                            {batiment_line}
                            <tr>
                                <td class="c" colspan="8">Productions ministres et bonus</td>
                            </tr>
                            {bonus_line}
                            <tr>
                                <td class="c" colspan="8">Productions materiels</td>
                            </tr>
                            {material_line}
                            <tr>
                                <td class="c" colspan="8">Total / Pr&eacute;visionel</td>
                            </tr>

                            {total}
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>