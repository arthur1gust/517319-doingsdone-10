<main class="content__main">
    <h2 class="content__main-heading">Добавление задачи</h2>

    <formclass="form" action="add.php" method="post">
        <div class="form__row">
            <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input <?php if (isset($errors['file_name'])): ?>form__input--error<?php endif; ?>"
                   type="text" name="name" id="name" value="<?php if (isset($tasks_add['name'])) {
                echo($tasks_add['name']);
            } ?>" placeholder="Введите название">
            <?php if (isset($errors['file_name'])): ?><p
                    class="form__message"><?php echo $errors['file_name']; ?></p><?php endif; ?>
        </div>

        <div class="form__row">
            <label class="form__label" for="project">Проект <sup>*</sup></label>
            <select class="form__input form__input--select" name="project" id="project">
                <?php foreach ($categories as $category_value): ?>
                    <option value="<?= $category_value['category_id']; ?>"
                            <?php if (isset($tasks_add['project_id']) && $tasks_add['project_id'] == $category_value['category_id']): ?>selected<?php endif; ?>> <?= $category_value['category_name']; ?></option>
                <?php endforeach; ?>

            </select>
            <?php if (isset($errors['project_id'])): ?><p
                    class="form__message"><?php echo $errors['project_id']; ?></p><?php endif; ?>
        </div>

        <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date <?php if ($errors['date']): ?>form__input--error<?php endif; ?>"
                   type="date" name="date" id="date" value="<?php if (isset($tasks_add['date'])) {
                echo $tasks_add['date'];
            } ?>" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
            <?php if (isset($errors['date'])): ?><p
                    class="form__message"><?php echo $errors['date']; ?></p><?php endif; ?>
        </div>

        <div class="form__row">
            <label class="form__label" for="preview">Файл</label>

            <div class="form__input-file">
                <input class="visually-hidden" type="file" name="preview" id="preview" value="">

                <label class="button button--transparent" for="preview">
                    <span>Выберите файл</span>
                </label>
            </div>
        </div>

        <div class="form__row form__row--controls">
            <input class="button" type="submit" name="" value="Добавить">
        </div>
    </form>
</main>