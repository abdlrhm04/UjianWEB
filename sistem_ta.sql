-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Des 2023 pada 18.09
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistem_ta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_aktivitas` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `jumlah_volume_kegiatan` double NOT NULL,
  `sks_hasil` int(11) NOT NULL,
  `path_lampiran` varchar(255) NOT NULL,
  `no_penugasan` varchar(255) DEFAULT NULL,
  `jenis_lampiran` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `angka_kredit` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `nama_aktivitas`, `tahun_ajaran`, `tanggal_mulai`, `tanggal_berakhir`, `jumlah_volume_kegiatan`, `sks_hasil`, `path_lampiran`, `no_penugasan`, `jenis_lampiran`, `user_id`, `angka_kredit`) VALUES
(13, 'Perkuliahan', 'Ganjil 2023/2024', '2023-03-20', '2023-03-20', 24, 245, 'GLnyHFIY2IhCtTBeFhDCyfw1oieKszTQt7QLWTFl.pdf', 'SK.02.01.2023', 'SK', 1, 0.5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas_aktivitas`
--

CREATE TABLE `kelas_aktivitas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kelas_matkul` varchar(255) NOT NULL,
  `kelas_nama` varchar(255) NOT NULL,
  `kelas_waktu` time NOT NULL,
  `kelas_sks` int(11) NOT NULL,
  `aktivitas_id` int(11) NOT NULL,
  `kelas_hari` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `kelas_aktivitas`
--

INSERT INTO `kelas_aktivitas` (`id`, `kelas_matkul`, `kelas_nama`, `kelas_waktu`, `kelas_sks`, `aktivitas_id`, `kelas_hari`) VALUES
(4, 'Pemrograman Web', 'E', '14:10:00', 2, 13, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_12_22_094929_aktivitas', 2),
(9, '2023_12_24_190418_create_kelas_aktivitas_table', 3),
(10, '2023_12_24_191812_create_user_data_table', 4),
(11, '2023_12_27_132503_create_seminar_table', 5),
(13, '2023_12_28_045928_create_tugas_akhirs_table', 6),
(14, '2023_12_28_122525_create_pendamping_table', 6),
(15, '2023_12_28_132014_create_pengujis_table', 7),
(16, '2023_12_28_135142_create_pembimbings_table', 8),
(17, '2023_12_28_144040_create_pengembangan_p_k_s_table', 9),
(18, '2023_12_28_150006_create_pengembangan_bahan_ajars_table', 10),
(19, '2023_12_28_151055_create_orasi_ilmiahs_table', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orasi_ilmiahs`
--

CREATE TABLE `orasi_ilmiahs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tema_orasi` varchar(255) NOT NULL,
  `waktu` date NOT NULL,
  `lampiran_orasi` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orasi_ilmiahs`
--

INSERT INTO `orasi_ilmiahs` (`id`, `tema_orasi`, `waktu`, `lampiran_orasi`, `user_id`) VALUES
(1, '123', '2023-12-05', 'zQk1n9ZPs09jjUJEtCqFEiIVErwh5yBnO6E2vhiv.pdf', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembimbings`
--

CREATE TABLE `pembimbings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `no_sk` varchar(255) NOT NULL,
  `path_lampiran` varchar(255) NOT NULL,
  `path_foto_kegiatan` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pembimbings`
--

INSERT INTO `pembimbings` (`id`, `nama_kegiatan`, `tahun_ajaran`, `waktu`, `no_sk`, `path_lampiran`, `path_foto_kegiatan`, `user_id`) VALUES
(1, '123123', 'Ganjil 2023/2024', '2023-12-05 00:00:00', '214', 'tjqCf2h8V285gVcqS4t2R6EhNSApNy9SlIt77KOw.pdf', 'BL8xDPu0UGncUigefMw6D5gzsaVNM8euiVeqlEIq.pdf', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendampings`
--

CREATE TABLE `pendampings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_nim` varchar(255) NOT NULL,
  `mahasiswa_nama` varchar(255) NOT NULL,
  `jenis_kegiatan` varchar(255) NOT NULL,
  `tanggal_dimulai` datetime NOT NULL,
  `tanggal_berakhir` datetime NOT NULL,
  `no_sk` varchar(255) NOT NULL,
  `path_lampiran` varchar(255) NOT NULL,
  `path_foto_kegiatan` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pendampings`
--

INSERT INTO `pendampings` (`id`, `mahasiswa_nim`, `mahasiswa_nama`, `jenis_kegiatan`, `tanggal_dimulai`, `tanggal_berakhir`, `no_sk`, `path_lampiran`, `path_foto_kegiatan`, `user_id`) VALUES
(1, '123', '123', 'Magang', '2023-12-05 00:00:00', '2023-12-29 00:00:00', '4444', 'IYdAqvT9F18CsTsMT8HS5e15tkccThKTSbkv9Cxe.pdf', '45RJ9USJqctybyLlAgcSI5VVQpK4VzMoH1r7AYzo.pdf', 1),
(2, '202110370311178', 'Ricky Triyoga Wardhana', 'Tugas Akhir', '2023-12-06 00:00:00', '2023-12-29 00:00:00', '2222', 'rj0eFm1A9INRtcaU42Mv2PKXKsuY9RibcTQbbJmp.pdf', '6x4Oqn7XIFvWzyNmbHUccpyL6ndpY3tmGIFlXMEo.pdf', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembangan_bahan_ajars`
--

CREATE TABLE `pengembangan_bahan_ajars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_bahan_ajar` varchar(255) NOT NULL,
  `deskripsi_bahan_ajar` varchar(255) NOT NULL,
  `hasil_pengembangan` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengembangan_bahan_ajars`
--

INSERT INTO `pengembangan_bahan_ajars` (`id`, `jenis_bahan_ajar`, `deskripsi_bahan_ajar`, `hasil_pengembangan`, `user_id`) VALUES
(1, 'Hahaha', '12312', 'MxziDafIJZc3Zuni7sIwSGr43CTmc30N58DjvLf6.pdf', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengembangan_p_k_s`
--

CREATE TABLE `pengembangan_p_k_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matkul_pengembangan` varchar(255) NOT NULL,
  `deskripsi_pengembangan` varchar(255) NOT NULL,
  `hasil_pengembangan` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengembangan_p_k_s`
--

INSERT INTO `pengembangan_p_k_s` (`id`, `matkul_pengembangan`, `deskripsi_pengembangan`, `hasil_pengembangan`, `user_id`) VALUES
(1, 'WEb', 'Gas', 'RYmoWXIErnvzoBfXdSWGrkWz8LSTLtamwYWgzY8I.pdf', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengujis`
--

CREATE TABLE `pengujis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_nim` varchar(255) NOT NULL,
  `mahasiswa_nama` varchar(255) NOT NULL,
  `jenis_ujian_akhir` varchar(255) NOT NULL,
  `posisi_penguji` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `waktu` datetime NOT NULL,
  `no_sk` varchar(255) NOT NULL,
  `path_lampiran` varchar(255) NOT NULL,
  `path_foto_kegiatan` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pengujis`
--

INSERT INTO `pengujis` (`id`, `mahasiswa_nim`, `mahasiswa_nama`, `jenis_ujian_akhir`, `posisi_penguji`, `tahun_ajaran`, `waktu`, `no_sk`, `path_lampiran`, `path_foto_kegiatan`, `user_id`) VALUES
(1, '202110370311178', 'Riicky', 'Thesis', 'Penguji Utama', 'Ganjil 2023/2024', '2023-11-28 00:00:00', '123', 'MtmsXRXPwRPJEZbXzyyq7XMoLyqvkLVkEnyyWQyZ.pdf', '9p8RRgV1JHlkYAqEtlbh5A92ehVLvWW7MYdbiui8.pdf', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `seminars`
--

CREATE TABLE `seminars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_nim` varchar(255) NOT NULL,
  `mahasiswa_nama` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `waktu_seminar` datetime NOT NULL,
  `no_berita_acara` varchar(255) NOT NULL,
  `path_lampiran` varchar(255) NOT NULL,
  `path_foto_kegiatan` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `seminars`
--

INSERT INTO `seminars` (`id`, `mahasiswa_nim`, `mahasiswa_nama`, `tahun_ajaran`, `waktu_seminar`, `no_berita_acara`, `path_lampiran`, `path_foto_kegiatan`, `user_id`) VALUES
(5, '202110370311178', 'Riicky', 'Ganjil 2023/2024', '2023-12-20 00:00:00', 'SK.01/2023', 'oYjEYjzoUG7Z5wGBOtIB9340jmRYojk5Rj8UQxFj.png', 'llcN2kEJEJIJqtAPv5NemdMrEIvL1jbOom0nvT0d.png', 1),
(6, '2021103703111865', 'Dhoni', 'Ganjil 2023/2024', '2023-12-05 00:00:00', 'SK.01/2023', 'BNeDcxQU0R3PQHv3qtk28kuTPoIN5UbF7rkZrLrT.pdf', 'AfJcdwqps95PruiX3lmVASjSeGKxS9eY1seZepnh.jpg', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tugas_akhirs`
--

CREATE TABLE `tugas_akhirs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mahasiswa_nim` varchar(255) NOT NULL,
  `mahasiswa_nama` varchar(255) NOT NULL,
  `jenis_bimbingan` varchar(255) NOT NULL,
  `tahun_ajaran` varchar(255) NOT NULL,
  `tanggal_dimulai` datetime NOT NULL,
  `tanggal_berakhir` datetime NOT NULL,
  `jenis_pembimbing` varchar(255) NOT NULL,
  `no_sk` varchar(255) NOT NULL,
  `path_lampiran` varchar(255) NOT NULL,
  `path_foto_kegiatan` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tugas_akhirs`
--

INSERT INTO `tugas_akhirs` (`id`, `mahasiswa_nim`, `mahasiswa_nama`, `jenis_bimbingan`, `tahun_ajaran`, `tanggal_dimulai`, `tanggal_berakhir`, `jenis_pembimbing`, `no_sk`, `path_lampiran`, `path_foto_kegiatan`, `user_id`) VALUES
(1, '124', '124', 'Skripsi', 'Ganjil 2023/2024', '2023-12-05 00:00:00', '2023-12-21 00:00:00', 'Pendamping Utama', '214', 'ncKgs814dj7boIGxGeBsf1bs4gqt88TS6vJXmtLu.pdf', 'UsWyUO4WAu9fcMx18Bll5In1QmAtw0dR463sb3FL.pdf', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Ricky Triyoga', 'rickytriyoga55@gmail.com', NULL, '$2y$10$LhMzetaJCJxAeb8XA8HMAeJs/YHC/BC4YRdwhnOJvbVUZgbk0Rjdi', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_data`
--

CREATE TABLE `user_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_tempat_lahir` varchar(255) NOT NULL,
  `user_tanggal_lahir` date NOT NULL,
  `user_nidn` varchar(255) NOT NULL,
  `user_golongan` varchar(255) NOT NULL,
  `user_pangkat` varchar(255) NOT NULL,
  `user_pendidikan_terkahir` varchar(255) NOT NULL,
  `user_pendidikans1` varchar(255) NOT NULL,
  `user_pendidikans2` varchar(255) NOT NULL,
  `user_pendidikans3` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `user_data`
--

INSERT INTO `user_data` (`id`, `user_name`, `user_tempat_lahir`, `user_tanggal_lahir`, `user_nidn`, `user_golongan`, `user_pangkat`, `user_pendidikan_terkahir`, `user_pendidikans1`, `user_pendidikans2`, `user_pendidikans3`, `user_id`) VALUES
(1, 'Ricky Triyoga Wardhana', 'Jombang', '2002-11-30', '0311178', 'Golongan 3A', 'Kepala Prodi', 'S3', 'Informatika - Universitas Muhammadiyah Malang', 'Magister Informatika - Universitas Bina Nusantara', 'Doktor Ilmu Komputer - Institut Teknologi Surabaya', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `kelas_aktivitas`
--
ALTER TABLE `kelas_aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orasi_ilmiahs`
--
ALTER TABLE `orasi_ilmiahs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `pembimbings`
--
ALTER TABLE `pembimbings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pendampings`
--
ALTER TABLE `pendampings`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengembangan_bahan_ajars`
--
ALTER TABLE `pengembangan_bahan_ajars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengembangan_p_k_s`
--
ALTER TABLE `pengembangan_p_k_s`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengujis`
--
ALTER TABLE `pengujis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indeks untuk tabel `seminars`
--
ALTER TABLE `seminars`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tugas_akhirs`
--
ALTER TABLE `tugas_akhirs`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indeks untuk tabel `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kelas_aktivitas`
--
ALTER TABLE `kelas_aktivitas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `orasi_ilmiahs`
--
ALTER TABLE `orasi_ilmiahs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pembimbings`
--
ALTER TABLE `pembimbings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pendampings`
--
ALTER TABLE `pendampings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `pengembangan_bahan_ajars`
--
ALTER TABLE `pengembangan_bahan_ajars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengembangan_p_k_s`
--
ALTER TABLE `pengembangan_p_k_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengujis`
--
ALTER TABLE `pengujis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `seminars`
--
ALTER TABLE `seminars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `tugas_akhirs`
--
ALTER TABLE `tugas_akhirs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user_data`
--
ALTER TABLE `user_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
