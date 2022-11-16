<style>
.loading {
    position: fixed;
    inset: 0;
    width: 400px;
    height: 240px;
    padding: 48px 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.7);
    border-radius: 8px;
    background: var(--bg-primary);
    margin: auto;
    z-index: 999;
}

.loading.d-none {
    display: none;
}

.loading img {
    width: 40px;
    height: 40px;
}

@media (max-width: 576px) {
    .loading {
        width: 100vw;
        height: 100vh;
        box-shadow: unset;
        border-radius: unset;
    }
}
</style>
<div class="loading d-none">
    <img src="https://res.cloudinary.com/ninhnam/image/upload/v1668532324/e-commerce/loading_yqlyyi.gif"
        alt="thuong-mai-dien-tu" />
</div>