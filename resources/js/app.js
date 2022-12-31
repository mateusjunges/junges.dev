import "../css/app.css";

Array.from(document.querySelectorAll("[data-lazy]")).forEach(lazy);

function lazy(element) {
    function observerCallback(entries, observer) {
        entries.forEach((entry) => {
            if (!entry.isIntersecting) {
                return;
            }

            if (element.dataset.lazy === "twitter") {
                loadTwitter();
                observer.disconnect();
                return;
            }

            const template = element.querySelector("template");
            const contents = document.importNode(template.content, true);
            element.appendChild(contents);
            observer.disconnect();
        });
    }

    const observer = new IntersectionObserver(observerCallback, {
        rootMargin: "500px",
    });

    observer.observe(element);
}

let twitterLoaded = false;

function loadTwitter() {
    if (twitterLoaded) {
        return;
    }

    const script = document.createElement("script");
    script.src = "https://platform.twitter.com/widgets.js";

    document.body.appendChild(script);
}

const copyIcon = `<svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="copy-docs-icon">
<path fill-rule="evenodd" d="M0 6.75C0 5.784.784 5 1.75 5h1.5a.75.75 0 010 1.5h-1.5a.25.25 0 00-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 00.25-.25v-1.5a.75.75 0 011.5 0v1.5A1.75 1.75 0 019.25 16h-7.5A1.75 1.75 0 010 14.25v-7.5z"></path><path fill-rule="evenodd" d="M5 1.75C5 .784 5.784 0 6.75 0h7.5C15.216 0 16 .784 16 1.75v7.5A1.75 1.75 0 0114.25 11h-7.5A1.75 1.75 0 015 9.25v-7.5zm1.75-.25a.25.25 0 00-.25.25v7.5c0 .138.112.25.25.25h7.5a.25.25 0 00.25-.25v-7.5a.25.25 0 00-.25-.25h-7.5z"></path>
</svg>`;

const copiedIcon = `<svg aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true" class="docs-copied-icon">
    <path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path>
</svg>`;

let blocks = document.querySelectorAll("pre");

blocks.forEach((block) => {
    if (!navigator.clipboard) {
        return;
    }

    let button = document.createElement("button");
    button.className = "button-copy-code";
    button.innerHTML = copyIcon;
    block.appendChild(button);

    button.addEventListener("click", async () => {
        await copyCode(block);
    });
});

async function copyCode(block) {
    let copiedCode = block.cloneNode(true);
    copiedCode.removeChild(copiedCode.querySelector("button.button-copy-code"));

    const html = copiedCode.outerHTML.replace(/<[^>]*>?/gm, "");

    block.querySelector("button.button-copy-code").innerHTML = copiedIcon;
    setTimeout(function () {
        block.querySelector("button.button-copy-code").innerHTML = copyIcon;
    }, 3000);

    const parsedHTML = htmlDecode(html);

    await navigator.clipboard.writeText(parsedHTML);
}

function htmlDecode(input) {
    const doc = new DOMParser().parseFromString(input, "text/html");
    return doc.documentElement.textContent;
}
