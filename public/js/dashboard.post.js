Alpine.data("posts", () => ({
    paginatedPosts: function () {
        const start = (this.currentPage - 1) * this.itemsPerPage;
        const end = start + this.itemsPerPage;
        return this.posts.slice(start, end);
    },
}));
