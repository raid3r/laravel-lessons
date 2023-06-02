<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Symfony\Component\HttpFoundation\Request;

class CountryController extends Controller
{

    public function index(): View
    {
        return view(
            'pages.country.index'
        );
    }

    public function search($query = '') {
        $countries = [
            'Австралія',
            'Австрія',
            'Азербайджан',
            'Албанія',
            'Алжир',
            'Ангола',
            'Андорра',
            'Антигуа і Барбуда',
            'Аргентина',
            'Афганістан',
            'Багамські Острови',
            'Бангладеш',
            'Барбадос',
            'Бахрейн',
            'Беліз',
            'Бельгія',
            'Бенін',
            'Білорусь',
            'Болгарія',
            'Болівія',
            'Боснія і Герцеговина',
            'Ботсвана',
            'Бразилія',
            'Бруней',
            'Буркіна-Фасо',
            'Бурунді',
            'Бутан',
            'В\'єтнам',
            'Вануату',
            'Ватикан',
            'Велика Британія',
            'Венесуела',
            'Вірменія',
            'Габон',
            'Гаїті',
            'Гайана',
            'Гамбія',
            'Гана',
            'Гватемала',
            'Гвінея',
            'Гвінея - Бісау',
            'Гондурас',
            'Гренада',
            'Греція',
            'Грузія',
            'Данія',
            'Джибуті',
            'Домініка',
            'Домініканська Республіка',
            'Еквадор',
            'Екваторіальна Гвінея',
            'Еритрея',
            'Естонія',
            'Есватіні',
            'Ефіопія',
            'Єгипет',
            'Ємен',
            'Замбія',
            'Західна Сахара',
            'Зімбабве',
            'Ізраїль',
            'Індія',
            'Індонезія',
            'Ірак',
            'Іран',
            'Ірландія',
            'Ісландія',
            'Іспанія',
            'Італія',
            'Йорданія',
            'Кабо-Верде',
            'Казахстан',
            'Камбоджа',
            'Камерун',
            'Канада',
            'Катар',
            'Кенія',
            'Киргизстан',
            'Китай',
            'Кіпр',
            'Колумбія',
            'Коморські Острови',
            "Конго",
            "Коста-Рика",
            "Кот-д'Івуар",
            "Куба",
            "Кувейт",
            "Лаос",
            "Латвія",
            "Лесото",
            "Литва",
            "Ліберія",
            "Ліван",
            "Лівія",
            "Ліхтенштейн",
            "Люксембург",
            "Маврикій",
            "Мавританія",
            "Мадагаскар",
            "Македонія",
            "Малаві",
            "Малайзія",
            "Малі",
            "Мальдіви",
            "Мальта",
            "Марокко",
            "Маршаллові Острови",
            "Мексика",
            "Мозамбік",
            "Молдова",
            "Монако",
            "Монголія",
            "М'янма (Бірма)",
            "Намібія",
            "Науру",
            "Непал",
            "Нігер",
            "Нігерія",
            "Нідерланди",
            "Нікарагуа",
            "Німеччина",
            "Нова Зеландія",
            "Норвегія",
            "Об'єднані Арабські Емірати",
            "Оман",
            "Пакистан",
            "Палау",
            "Панама",
            "Папуа-Нова Гвінея",
            "Парагвай",
            "Перу",
            "Південна Корея",
            "Південний Судан",
            "Північна Корея",
            "Польща",
            "Португалія",
            "Росія",
            "Руанда",
            "Румунія",
            "Сальвадор",
            "Самоа",
            "Сан-Марино",
            "Сан-Томе і Прінсіпі",
            "Саудівська Аравія",
            "Свазіленд",
            "Сейшельські Острови",
            "Сенегал",
            "Сент-Кіттс і Невіс",
            "Сент-Люсія",
            "Сербія",
            "Сінгапур",
            "Сирія",
            "Словаччина",
            "Словенія",
            "Соломонові Острови",
            "Сомалі",
            "Судан",
            "Суринам",
            "Східний Тимор",
            "США",
            "Сьєрра-Леоне",
            "Таджикистан",
            "Таїланд",
            "Танзанія",
            "Того",
            "Тонга",
            "Тринідад і Тобаго",
            "Тувалу",
            "Туніс",
            "Туреччина",
            "Туркменістан",
            "Уганда",
            "Угорщина",
            "Узбекистан",
            "Україна",
            "Уругвай",
            "Фіджі",
            "Філіппіни",
            "Фінляндія",
            "Франція",
            "Хорватія",
            "Центральноафриканська Республіка",
            "Чад",
            "Чехія",
            "Чилі",
            "Чорногорія",
            "Швейцарія",
            "Швеція",
            "Шрі-Ланка",
            "Ямайка",
            "Японія",
        ];

        $countries = array_filter($countries, function ($name) use ($query) {
            return str_contains(mb_strtolower($name), mb_strtolower($query));
        });

        return response()->json($countries);
    }
}
