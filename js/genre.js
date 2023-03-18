function editGenre(genreId) {
    window.location = "index.php?menu=genre_update&id=" + genreId;
}

function deleteGenre(genreId) {
    const confirmaton = window.confirm("Are you sure want to delete this data?");
    if (confirmaton) {
        window.location = "index.php?menu=genre&com=del&gid" + genreId;
    }
}