USE Doingsdone;

INSERT INTO users
SET name = 'Антон', email = 'antiny@mail.ru', password = 'password1';
INSERT INTO users
SET name = 'Адександр', email = 'alex@gmail.com', password = 'password2';
INSERT INTO users
SET name = 'Анна', email = 'anna@yandex.ru', password = 'password3';

INSERT INTO projects
SET  user_id = '1', title = 'Входящие';
INSERT INTO projects
SET  user_id = '1', title = 'Учеба';
INSERT INTO projects
SET  user_id = '1', title = 'Работа';
INSERT INTO projects
SET  user_id = '1', title = 'Домашние дела';
INSERT INTO projects
SET  user_id = '1', title = 'Авто';

INSERT INTO projects
SET  user_id = '2', title = 'Входящие';
INSERT INTO projects
SET  user_id = '2', title = 'Учеба';
INSERT INTO projects
SET  user_id = '2', title = 'Работа';
INSERT INTO projects
SET  user_id = '2', title = 'Домашние дела';
INSERT INTO projects
SET  user_id = '2', title = 'Авто';

INSERT INTO projects
SET  user_id = '3', title = 'Входящие';
INSERT INTO projects
SET  user_id = '3', title = 'Учеба';
INSERT INTO projects
SET  user_id = '3', title = 'Работа';
INSERT INTO projects
SET  user_id = '3', title = 'Домашние дела';
INSERT INTO projects
SET  user_id = '3', title = 'Авто';

INSERT INTO tasks
SET  user_id = '1', project_id = '3', name_task = 'Собеседование в IT компании', dt_doing = '2019-12-01', status = '0';
INSERT INTO tasks
SET  user_id = '1', project_id = '3', name_task = 'Выполнить тестовое задание', dt_doing = '2018-12-25', status = '0';
INSERT INTO tasks
SET  user_id = '1', project_id = '2', name_task = 'Сделать задание первого раздела', dt_doing = '2018-12-21', status = '1';
INSERT INTO tasks
SET  user_id = '1', project_id = '1', name_task = 'Встреча с другом', dt_doing = '2018-12-22', status = '0';
INSERT INTO tasks
SET  user_id = '1', project_id = '4', name_task = 'Купить корм для кота', status = '0';
INSERT INTO tasks
SET  user_id = '1', project_id = '4', name_task = 'Заказать пиццу', status = '0';

INSERT INTO tasks
SET  user_id = '2', project_id = '8', name_task = 'Собеседование в IT компании', dt_doing = '2019-12-01', status = '0';
INSERT INTO tasks
SET  user_id = '2', project_id = '8', name_task = 'Выполнить тестовое задание', dt_doing = '2018-12-25', status = '0';
INSERT INTO tasks
SET  user_id = '2', project_id = '7', name_task = 'Сделать задание первого раздела', dt_doing = '2018-12-21', status = '1';
INSERT INTO tasks
SET  user_id = '2', project_id = '6', name_task = 'Встреча с другом', dt_doing = '2018-12-22', status = '0';
INSERT INTO tasks
SET  user_id = '2', project_id = '9', name_task = 'Купить корм для кота', status = '0';

INSERT INTO tasks
SET  user_id = '3', project_id = '13', name_task = 'Собеседование в IT компании', dt_doing = '2019-12-01', status = '0';
INSERT INTO tasks
SET  user_id = '3', project_id = '12', name_task = 'Сделать задание первого раздела', dt_doing = '2018-12-21', status = '1';
INSERT INTO tasks
SET  user_id = '3', project_id = '11', name_task = 'Встреча с другом', dt_doing = '2018-12-22', status = '0';
INSERT INTO tasks
SET  user_id = '3', project_id = '14', name_task = 'Заказать пиццу', status = '0';
INSERT INTO tasks
SET  user_id = '3', project_id = '15', name_task = 'Визит в автосервис', status = '0';
