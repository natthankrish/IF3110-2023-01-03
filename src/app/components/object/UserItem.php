<tr>
    <td><?= $i ?></td>
    <td><?= $user->fullname ?></td>
    <td><?= $user->username ?></td>
    <td><?= $user->email ?></td>
    <td><?= number_format(($user->storage - $user->storage_left) / 1024, 2) ?>GB</td>
    <td class="button-column"><a href="/public/admin/user/<?= $user->username ?>" class="button">Manage Account</a></td>
</tr>