<?php


?>

<?php if (isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-success"><?= $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?></div>
<?php endif; ?>

<?php if (isset($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger"><?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?></div>
<?php endif; ?>

<h2>Tableau de bord</h2>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Dernières annonces
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Véhicule</th>
                            <th>Département</th>
                            <th>Utilisateur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($annonces as $annonce): ?>
                        <tr>
                            <td><?= htmlspecialchars($annonce['id_annonce']) ?></td>
                            <td><?= htmlspecialchars($annonce['vehicule']) ?></td>
                            <td><?= htmlspecialchars($annonce['departement']) ?></td>
                            <td><?= htmlspecialchars($annonce['prenom'].' '.$annonce['nom']) ?></td>
                            <td>
                                <form method="POST" style="display:inline;">
                                    <input type="hidden" name="annonce_id" value="<?= $annonce['id_annonce'] ?>">
                                    <button type="submit" name="delete_annonce" class="btn btn-danger btn-sm" 
                                        onclick="return confirm('Supprimer cette annonce ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <!-- Pagination -->
                <nav>
                    <ul class="pagination">
                        <?php for ($i = 1; $i <= ceil($totalAnnonces / 10); $i++): ?>
                            <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                                <a class="page-link" href="admin.php?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success text-white">
                Derniers utilisateurs
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach (array_slice($users, 0, 5) as $user): ?>
                        <tr>
                            <td><?= htmlspecialchars($user['id']) ?></td>
                            <td><?= htmlspecialchars($user['prenom'].' '.$user['nom']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>