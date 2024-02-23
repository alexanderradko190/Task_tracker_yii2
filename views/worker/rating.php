<?php
/** @var yii\web\View $this */

$this->title = 'Рейтинг исполнителей';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="rating-workers-page w-50">
<table class="w-100">
    <thead>
    <tr>
        <th class="border border-dark text-center m-4 p-4">Исполнитель</th>
        <th class="border border-dark text-center m-4 p-4">Баллы</th>
    </tr>
    </thead>
    <tbody>

<?php foreach ($ratingData as $item) {
    ?>
        <tr>
            <td class="w-70 border border-dark m-4 p-4">
                <div><?= $item['username']; ?></div>
            </td>
            <td class="w-30 border border-dark m-4 p-4">
                <div class="text-center"><?php if ($item['rating'] === null) {
                        $rating = 0;
                    } else {
                        $rating = $item['rating'];
                    }
                    echo $rating;
                    ?>
                </div>
            </td>
        </tr>
<?php } ?>

    </tbody>
</table>
</div>

