<?php
use App\Models\pinjam;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('dashboard'));
});
Breadcrumbs::for('pinjam', function (BreadcrumbTrail $trail) {
    $trail->push('Peminjaman Ruang', route('pinjam.index'));
});
Breadcrumbs::for ('pinjamtambah', function (BreadcrumbTrail $trail) {
    $trail->parent('pinjam');
    $trail->push('Tambah', route('pinjam.create'));
});
Breadcrumbs::for ('setuju', function (BreadcrumbTrail $trail) {
    $trail->parent('pinjam');
    $trail->push('Setuju', route('pinjam.setuju'));
});
Breadcrumbs::for ('proses', function (BreadcrumbTrail $trail) {
    $trail->parent('pinjam');
    $trail->push('Proses', route('pinjam.proses'));
});
Breadcrumbs::for ('tolak', function (BreadcrumbTrail $trail) {
    $trail->parent('pinjam');
    $trail->push('Tolak', route('pinjam.tolak'));
});
Breadcrumbs::for ('ajukan', function (BreadcrumbTrail $trail, pinjam $pinjam) {
    $trail->parent('tolak');
    $trail->push('Ajukan Kembali ', route('pinjam.ajukan',$pinjam));
});
Breadcrumbs::for('profil', function (BreadcrumbTrail $trail) {
    $trail->push('Profil', route('profil'));
});
Breadcrumbs::for('ganpas', function (BreadcrumbTrail $trail) {
    $trail->parent('profil');
    $trail->push('Ganti Password', route('gantiPassword'));
});
Breadcrumbs::for('ruang', function (BreadcrumbTrail $trail) {
    $trail->push('Ruang', route('ruang.index'));
});
Breadcrumbs::for('ruangtambah', function (BreadcrumbTrail $trail) {
    $trail->push('Ruang', route('ruang.index'));
});
Breadcrumbs::for('pengguna', function (BreadcrumbTrail $trail) {
    $trail->push('Pengguna', route('pengguna.index'));
});
Breadcrumbs::for('penanggungjawab', function (BreadcrumbTrail $trail) {
    $trail->push('Penanggung Jawab', route('penanggungjawab.index'));
});
Breadcrumbs::for('lantai', function (BreadcrumbTrail $trail) {
    $trail->push('Lantai', route('lantai.index'));
});
Breadcrumbs::for('status', function (BreadcrumbTrail $trail) {
    $trail->push('Status', route('status.index'));
});