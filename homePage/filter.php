<aside class="w-1/4 pr-8">
    <h2 class="text-lg font-bold mb-4">
        Filters
    </h2>
    <form method="GET" class="flex flex-wrap items-center gap-3 mb-8">
        <!-- Search -->
        <input
            type="search"
            name="search"
            value="<?= htmlspecialchars($search) ?>"
            placeholder="Tìm kiếm tên, mô tả, màu sắc..."
            class="w-60 p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-400 transition" />
        <!-- Category (filter theo từ khóa) -->
        <select name="category" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-400">
            <option value="">Tất cả danh mục</option>
            <option value="shirt" <?= ($category == 'shirt' ? 'selected' : '') ?>>Áo</option>
            <option value="pants" <?= ($category == 'pants' ? 'selected' : '') ?>>Quần</option>
            <option value="dress" <?= ($category == 'dress' ? 'selected' : '') ?>>Váy</option>
            <option value="shoes" <?= ($category == 'shoes' ? 'selected' : '') ?>>Giày</option>
            <!-- Thêm keyword khác nếu muốn -->
        </select>
        <!-- Colour filter -->
        <select name="colour" class="p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:border-blue-400">
            <option value="">Tất cả màu</option>
            <?php foreach ($colours as $col): ?>
                <option value="<?= htmlspecialchars($col) ?>" <?= ($colour == $col ? 'selected' : '') ?>>
                    <?= htmlspecialchars($col) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button
            type="submit"
            class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 font-semibold transition">
            Search
        </button>
    </form>
</aside>