<br />
<div id="content">

<div id="trie-button">
<button onclick="window.location.href='game.php?page=buildings&mode=fleet'">Vaisseaux</button> - <button onclick="window.location.href='game.php?page=buildings&mode=defense'" class="active">Defense</button>
</div>

    {message}
        <form action="" method="post">
            <table align="top" width="530">
                {buildlist}
                {build_defenses}
            </table>
        </form>
    {buildinglist}
</div>