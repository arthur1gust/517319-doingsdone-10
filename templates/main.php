<?php 
$show_complete_tasks = rand(0, 1);
?>
            <section class="content__side">
                <h2 class="content__side-heading">Проекты</h2>  
                <nav class="main-navigation">
                    <ul class="main-navigation__list">
					<?php foreach ($categories as $category_value): ?>
                        <li class="main-navigation__list-item">
							<a class="main-navigation__list-item-link" href="#=<?=$category_value;?>"><?= $category_value; ?></a>
                            <span class="main-navigation__list-item-count"><?= tasks_count($category_value, $tasks); ?></span>
                        </li>
						<?php 
							endforeach; 
						?>
                    </ul>
                </nav>
                <a class="button button--transparent button--plus content__side-button"
                   href="pages/form-project.html" target="project_add">Добавить проект</a>
            </section>

            <main class="content__main">
                <h2 class="content__main-heading">Список задач</h2>

                <form class="search-form" action="index.php" method="post" autocomplete="off">
                    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

                    <input class="search-form__submit" type="submit" name="" value="Искать">
                </form>

                <div class="tasks-controls">
                    <nav class="tasks-switch">
                        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
                        <a href="/" class="tasks-switch__item">Повестка дня</a>
                        <a href="/" class="tasks-switch__item">Завтра</a>
                        <a href="/" class="tasks-switch__item">Просроченные</a>
                    </nav>

                    <label class="checkbox">
                        <!--добавить сюда атрибут "checked", если переменная $show_complete_tasks равна единице-->
                        <input class="checkbox__input visually-hidden show_completed" type="checkbox" 
						<?php if ($show_complete_tasks === 1): ?>checked<?php endif; ?> >
                        <span class="checkbox__text">Показывать выполненные</span>
                    </label>
                </div>

                <table class="tasks">
				<?php foreach ($tasks as $tasks_key => $tasks_value): ?>
				<?php if ($show_complete_tasks === 1 OR $tasks_value['complete'] === 0) : ?>
                    <tr class="tasks__item task <?php if ($tasks_value['complete'] === 1): ?> task--completed <?php endif; 
						$time_call = call_date($tasks_value['date']); ?>
					<?php if ($time_call>0 && $time_call<=24): ?>
						task--important
					<?php endif ?>
                            ">
                        <td class="task__select">
                            <label class="checkbox task__checkbox">
                                <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1">
                                <span class="checkbox__text"><?= $tasks_value['name']; ?></span>
                            </label>
                        </td>
                        <td class="task__date"></td>
                    </tr>
					<?php endif; ?>
					<?php endforeach; ?>
                    <!--показывать следующий тег <tr/>, если переменная $show_complete_tasks равна единице-->
                </table>
            </main>
