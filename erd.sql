// ERD Database "Jadi Berangkat" - Laravel 10
// DBML: https://dbdiagram.io/d
// Docs: https://dbml.dbdiagram.io/docs

Table users {
  id int [primary key, increment]
  name varchar(255)
  email varchar(255) [unique]
  password varchar(255)
  created_at timestamp
  updated_at timestamp
}

Table destinasi {
  id int [primary key, increment]
  kategori varchar [ref: > global_kategori.id]
  nama varchar(255)
  slug varchar(255) [not null]
  deskripsi text
  lokasi varchar(255)
  harga decimal(15,2)
  gambar varchar(255) [note: 'Path file gambar utama']
  status varchar(20) [default: 'aktif']
  id_jadwal_perjalanan int [ref: > jadwal_perjalanan.id] 
  id_include int [ref: > include.id]
  id_un_include int [ref: > un_include.id]
  created_at timestamp
  updated_at timestamp
}

Table jadwal_perjalanan {
  id int [primary key]
  id_destinasi int [ref: > destinasi.id]
  judul varchar(255)
  deskripsi text
}

Table include {
  id int [primary key]
  id_destinasi int [ref: > destinasi.id]
  termasuk varchar(255)
}

Table un_include {
  id int [primary key]
  id_destinasi int [ref: > destinasi.id]
  tidak_termasuk varchar(255)
}

// 2. Baru panggil nama enum-nya di dalam tabel
Table galeri {
  id int [primary key, increment]
  karegori varchar [ref: > global_kategori.id]
  judul varchar(255)
  gambar varchar(255)
  deskripsi text
  slug varchar(255)
  created_at timestamp
  updated_at timestamp
}

Table artikel {
  id int [primary key, increment]
  judul varchar(255)
  slug varchar(255) [unique, not null]
  konten text [note: 'Konten HTML dari WYSIWYG editor']
  gambar varchar(255) [note: 'Path file thumbnail']
  status enum [default: 'draft', note: 'draft | terbit']
  created_at timestamp
  updated_at timestamp
}




Table Home {
  id int [primary key, increment]
  id_section_hero int [ref: > sect_hero.id]
  id_sect_cta_destinasi int [ref: > sect_cta_destinasi.id]
  id_sect_penawaran int [ref: > sect_penawaran.id]
  id_sect_statistik int [ref: > sect_statistik.id]
  id_sect_armada int [ref: > sect_armada.id]
  id_sect_ulasan int [ref: > sect_ulasan.id]
  id_sect_artikel int [ref: > section_artikel.id]
  created_at timestamp
  updated_at timestamp
}

Table sect_hero {
  id int [primary key]
  label varchar(50) [note: 'label di atas']
  judul_hero varchar(100)
  deskripsi_hero text
  btn varchar(20)
  statistik_data_1 int(5)
  statistik_deskripsi_1 varchar(20)
  statistik_data_2 int(5)
  statistik_deskripsi_2 varchar(20)
  statistik_data_3 int(5)
  statistik_deskripsi_3 varchar(20)
  embed_video text
}

enum format {
  jam
  hari
  bulan
}

enum mood {
  Sunrise
  Noon
  Afternoon
  Sunset
}


Table sect_penawaran {
  id int [primary key]
  judul varchar(100)
  id_card_penawaran int [ref: > card_penawaran.id]
}


Table global_trip {
  id int
  nama_trip varchar(255)
}

Table card_penawaran {
  id int [primary key]
  image varchar(255)
  durasi varchar(10)
  label_kategori varchar [ref: > global_trip.id]
  judul varchar(100)
  lokasi varchar(100)
  rating float
  review varchar(255)
  deskripsi text
  harga int
}


Table sect_statistik {
  id int [primary key]
  pengunjung int
  destinasi int
  rute int
  armada int
}

Table sect_armada {
  id int [primary key]
  judul varchar(100)
  deskripsi varchar(255)
  id_card_armada int [ref: > card_armada.id]
}

Table card_armada {
  id int [primary key]
  img varchar(255)
  judul varchar(255)
}

Table sect_ulasan {
  id int [primary key]
  label varchar(255)
  judul varchar(255)
  deskripsi varchar(255)
  id_card_review int [ref: > card_review.id]
}

Table card_review {
  id int [primary key]
  bintang int(5)
  pesan text
  gambar_profile varchar(255)
  nama_user varchar(50)
  kategori varchar(20)

}

Table section_artikel {
  id int [primary key]
  label varchar(20)
  deskripsi text
  id_artikel_card_home int [ref: > artikel_card_home.id]

}

Table artikel_card_home {
  id int [primary key]
  gambar varchar(255)
  label varchar(20)
  judul varchar(100)
  deskripsi text
  slug varchar(255)
}

Table privasi {
  id int [primary key]
  judul varchar(100)
  deskripsi text
}

Table footer_privasi {
  deskripsi text
}

Table global_footer {
  logo varchar(255)
  deskripsi text
  media_sosial int [ref: > media_sosial.id]
}


Table media_sosial {
  id int [primary key, increment]
  platform enum [note: 'Instagram, Facebook, Twitter, dll']
  link varchar(255)
  created_at timestamp
  updated_at timestamp
}



//arya
Table About {
    id int [primary key, increment]
      id_sect_about_hero int [ref: > sect_about_hero.id]
        id_sect_kisah int [ref: > sect_kisah.id]
          id_sect_visimisi int [ref: > sect_visimisi.id]
            id_sect_nilai int [ref: > sect_nilai.id]
              id_sect_galeri_about int [ref: > sect_galeri_about.id]
                created_at timestamp
                  updated_at timestamp
                  }

                  Table sect_about_hero {
                    id int [primary key]
                      label varchar(50) [note: 'Tentang Kami']
                        judul varchar(100)
                          deskripsi text
                            statistik_data_1 varchar(10)
                              statistik_deskripsi_1 varchar(50)
                                statistik_data_2 varchar(10)
                                  statistik_deskripsi_2 varchar(50)
                                    statistik_data_3 varchar(10)
                                      statistik_deskripsi_3 varchar(50)
                                        statistik_data_4 varchar(10)
                                          statistik_deskripsi_4 varchar(50)
                                            gambar_kanan varchar(255)
                                              tag_overlay varchar(50)
                                                judul_overlay varchar(100)
                                                }

                                                Table sect_kisah {
                                                  id int [primary key]
                                                    label varchar(50) [note: 'Kisah Kami']
                                                      judul varchar(100)
                                                        deskripsi_1 text
                                                          deskripsi_2 text
                                                            highlight_text text
                                                              gambar_1 varchar(255)
                                                                gambar_2 varchar(255)
                                                                  badge_text varchar(50) [note: '100% Local Empowerment']
                                                                  }

                                                                  Table sect_visimisi {
                                                                    id int [primary key]
                                                                      label varchar(50) [note: 'Landasan Kami']
                                                                        judul varchar(100)
                                                                          visi_deskripsi text
                                                                            id_misi_item int [ref: > misi_item.id]
                                                                            }

                                                                            Table misi_item {
                                                                              id int [primary key]
                                                                                nomor varchar(5)
                                                                                  deskripsi text
                                                                                  }

                                                                                  Table sect_nilai {
                                                                                    id int [primary key]
                                                                                      label varchar(50) [note: 'Nilai Kami']
                                                                                        judul varchar(100)
                                                                                          id_card_nilai int [ref: > card_nilai.id]
                                                                                          }

                                                                                          Table card_nilai {
                                                                                            id int [primary key]
                                                                                              icon varchar(50)
                                                                                                judul varchar(100)
                                                                                                  deskripsi text
                                                                                                  }

                                                                                                  Table sect_galeri_about {
                                                                                                    id int [primary key]
                                                                                                      label varchar(50) [note: 'Galeri Kegiatan']
                                                                                                        judul varchar(100)
                                                                                                          tombol_teks varchar(50)
                                                                                                            id_galeri_item int [ref: > galeri_item_about.id]
                                                                                                            }

                                                                                                            Table galeri_item_about {
                                                                                                              id int [primary key]
                                                                                                                gambar varchar(255)
                                                                                                                  tag varchar(50)
                                                                                                                    is_video boolean [default: false]
                                                                                                                    }



Table about {
    id_section_hero int [ref: > section_hero.id]
      id_section_artikel int [ref: > artikel_news.id]
      }

      Table section_hero {
        id int
          gambar varchar(255)
            label varchar(100)
              judul varchar(100)
                deskripsi text
                }

                Enum format_durasi {
                  jam
                    min
                    }

                    Table artikel_news {
                      id int 
                        gambar varchar(255)
                          label_category varchar(20)
                            judul varchar(100)
                              deskripsi text
                                tanggal datetime
                                  slug varchar(255)
                                    durasi int 
                                      format_durasi format_durasi
                                        isi_artikel text
                                        }

Table faq {
  id int [primary key]
  judul varchar(255)
  deskripsi text
}

Table global_kategori {
  id int [primary key]
  nama_kategori varchar(255)
}